<?php

namespace App\Http\Controllers;

use App\Models\SfoActivity;
use App\Models\Project;
use App\Models\Location;
use App\Models\WorkType;
use App\Exports\SfoExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SFOController extends Controller
{
    public function index(Request $request)
    {
        $query = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])
            ->orderBy('tanggal_sfo', 'desc');
        if ($request->has('filter_type')) {
            switch ($request->filter_type) {
                case 'pertanggal':
                    if ($request->has('tgl_awal') && $request->has('tgl_akhir')) {
                        $query->whereBetween('tanggal_sfo', [$request->tgl_awal, $request->tgl_akhir]);
                    }
                    break;

                case 'perbulan':
                    if ($request->has('bulan')) {
                        $month = date('m', strtotime($request->bulan));
                        $year = date('Y', strtotime($request->bulan));
                        $query->whereYear('tanggal_sfo', $year)
                            ->whereMonth('tanggal_sfo', $month);
                    }
                    break;

                case 'pertahun':
                    if ($request->has('tahun')) {
                        $query->whereYear('tanggal_sfo', $request->tahun);
                    }
                    break;
            }
        }

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('projek', function ($q) use ($searchTerm) {
                    $q->where('nama_projek', 'like', "%{$searchTerm}%");
                })
                    ->orWhereHas('lokasi', function ($q) use ($searchTerm) {
                        $q->where('jalur', 'like', "%{$searchTerm}%")
                            ->orWhere('lajur', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('jenisPekerjaan', function ($q) use ($searchTerm) {
                        $q->where('nama_pekerjaan', 'like', "%{$searchTerm}%");
                    })
                    ->orWhere('notes', 'like', "%{$searchTerm}%")
                    ->orWhere('sta_awal', 'like', "%{$searchTerm}%")
                    ->orWhere('sta_akhir', 'like', "%{$searchTerm}%");
            });
        }

        $sfoActivities = $query->paginate(10);

        $projects = Project::all();
        $locations = Location::all();
        $workTypes = WorkType::all();

        $modalProjects = Project::select('id', 'nama_projek', 'tahun_projek', 'lokasi')
            ->orderBy('nama_projek')
            ->paginate(5)
            ->withQueryString();


        return view('data_sfo.index', compact('sfoActivities', 'projects', 'locations', 'workTypes', 'modalProjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::orderBy('nama_projek')->get();
        $locations = Location::orderBy('jalur')->orderBy('lajur')->get();
        $workTypes = WorkType::orderBy('nama_pekerjaan')->get();

        return view('data_sfo.create', compact('projects', 'locations', 'workTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'tanggal_sfo' => 'required|date',
            'sta_awal' => 'required|integer|min:0',
            'sta_akhir' => 'required|integer|min:0|gte:sta_awal',
            'location_id' => 'required|exists:locations,id',
            'panjang' => 'required|numeric|min:0.01',
            'lebar' => 'required|numeric|min:0.01',
            'tebal' => 'required|numeric|min:0.01',
            'luas' => 'required|numeric|min:0.01',
            'work_type_id' => 'required|exists:work_types,id',
            'status' => 'required|in:Unprocessed,Process,Done',
            'notes' => 'nullable|string|max:1000'
        ], [
            'sta_akhir.gte' => 'STA akhir harus lebih besar atau sama dengan STA awal.',
            'project_id.required' => 'Projek harus dipilih.',
            'location_id.required' => 'Lokasi harus dipilih.',
            'work_type_id.required' => 'Jenis pekerjaan harus dipilih.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan dalam input data.');
        }

        try {
            DB::beginTransaction();

            SfoActivity::create($request->all());

            DB::commit();

            return redirect()->route('sfo.index')
                ->with('success', 'Data SFO berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SfoActivity $sfo)
    {
        $sfo->load(['projek', 'lokasi', 'jenisPekerjaan']);
        return view('data_sfo.show', compact('sfo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SfoActivity $sfo)
    {
        $projects = Project::orderBy('nama_projek')->get();
        $locations = Location::orderBy('jalur')->orderBy('lajur')->get();
        $workTypes = WorkType::orderBy('nama_pekerjaan')->get();

        return view('data_sfo.edit', compact('sfo', 'projects', 'locations', 'workTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SfoActivity $sfo)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'tanggal_sfo' => 'required|date',
            'sta_awal' => 'required|integer|min:0',
            'sta_akhir' => 'required|integer|min:0|gte:sta_awal',
            'location_id' => 'required|exists:locations,id',
            'panjang' => 'required|numeric|min:0.01',
            'lebar' => 'required|numeric|min:0.01',
            'tebal' => 'required|numeric|min:0.01',
            'luas' => 'required|numeric|min:0.01',
            'work_type_id' => 'required|exists:work_types,id',
            'status' => 'required|in:Unprocessed,Process,Done',
            'notes' => 'nullable|string|max:1000'
        ], [
            'sta_akhir.gte' => 'STA akhir harus lebih besar atau sama dengan STA awal.',
            'project_id.required' => 'Projek harus dipilih.',
            'location_id.required' => 'Lokasi harus dipilih.',
            'work_type_id.required' => 'Jenis pekerjaan harus dipilih.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan dalam input data.');
        }

        try {
            DB::beginTransaction();

            $sfo->update($request->all());

            DB::commit();

            return redirect()->route('sfo.index')
                ->with('success', 'Data SFO berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SfoActivity $sfo)
    {
        try {
            $sfo->delete();
            return redirect()->route('sfo.index')
                ->with('success', 'Data SFO berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('sfo.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update status of SFO activity
     */
    public function updateStatus(Request $request, SfoActivity $sfo)
    {
        $request->validate([
            'status' => 'required|in:Unprocessed,Process,Done'
        ]);

        try {
            $sfo->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate luas automatically
     */
    public function calculateLuas(Request $request)
    {
        $request->validate([
            'panjang' => 'required|numeric|min:0.01',
            'lebar' => 'required|numeric|min:0.01'
        ]);

        $luas = $request->panjang * $request->lebar;

        return response()->json([
            'success' => true,
            'luas' => number_format($luas, 2, '.', '')
        ]);
    }

    /**
     * Export SFO report by project or year
     */
    /**
     * Export SFO report by project or year
     */
    public function exportReport(Request $request)
    {
        try {
            $projectId = $request->input('project_id');
            $year = $request->input('year');

            // Validasi: harus ada project_id atau year
            if (!$projectId && !$year) {
                return redirect()->back()
                    ->with('error', 'Pilih projek atau tahun untuk mengekspor data.');
            }

            $fileName = 'laporan_sfo';

            if ($projectId) {
                $project = Project::find($projectId);
                if (!$project) {
                    return redirect()->back()
                        ->with('error', 'Projek tidak ditemukan.');
                }
                $fileName .= '_' . Str::slug($project->nama_projek, '_');
            }

            if ($year) {
                $fileName .= '_' . $year;
            }

            $fileName .= '.xlsx';

            return Excel::download(new SfoExport($projectId, $year), $fileName);

        } catch (\Exception $e) {
            Log::error('Export error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}