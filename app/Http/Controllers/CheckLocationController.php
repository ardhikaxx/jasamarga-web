<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SfoActivity;
use App\Models\Project;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class CheckLocationController extends Controller
{
    public function index()
    {
        // Ambil data jalur yang tersedia
        $jalurOptions = Location::distinct()->pluck('jalur');
        
        // Ambil tahun projek yang tersedia
        $tahunOptions = Project::distinct()->pluck('tahun_projek');
        
        return view('check_location.index', compact('jalurOptions', 'tahunOptions'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'sta_awal' => 'required|integer',
            'sta_akhir' => 'required|integer',
            'jalur' => 'required|string',
            'tahun' => 'required|integer',
            'tanggal_sfo' => 'nullable|date'
        ]);

        $staAwal = $request->sta_awal;
        $staAkhir = $request->sta_akhir;
        $jalur = $request->jalur;
        $tahun = $request->tahun;
        $tanggalSfo = $request->tanggal_sfo;

        // Query untuk mencari data SFO yang sesuai
        $query = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])
            ->whereHas('projek', function($q) use ($tahun) {
                $q->where('tahun_projek', $tahun);
            })
            ->whereHas('lokasi', function($q) use ($jalur) {
                $q->where('jalur', $jalur);
            });

        // Filter berdasarkan STA range
        $query->where(function($q) use ($staAwal, $staAkhir) {
            $q->whereBetween('sta_awal', [$staAwal, $staAkhir])
              ->orWhereBetween('sta_akhir', [$staAwal, $staAkhir])
              ->orWhere(function($q2) use ($staAwal, $staAkhir) {
                  $q2->where('sta_awal', '<=', $staAwal)
                     ->where('sta_akhir', '>=', $staAkhir);
              });
        });

        // Filter tambahan berdasarkan tanggal jika diisi
        if ($tanggalSfo) {
            $query->whereDate('tanggal_sfo', $tanggalSfo);
        }

        $sfoActivities = $query->get();

        if ($sfoActivities->isEmpty()) {
            return redirect()->route('check-location')
                ->with('error', 'Tidak ditemukan data SFO untuk kriteria yang dimasukkan.')
                ->withInput();
        }

        // Jika hanya ditemukan satu data, langsung redirect ke detail
        if ($sfoActivities->count() === 1) {
            return redirect()->route('check-location.detail', $sfoActivities->first()->id);
        }

        // Jika ditemukan multiple data, tampilkan pilihan
        return view('check_location.results', compact('sfoActivities', 'staAwal', 'staAkhir', 'jalur', 'tahun'));
    }

    public function detail($id)
    {
        $sfo = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])->findOrFail($id);
        
        return view('check_location.detail', compact('sfo'));
    }
}