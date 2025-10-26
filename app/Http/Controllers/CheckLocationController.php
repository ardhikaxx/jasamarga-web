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
        $tahunOptions = Project::distinct()->pluck('tahun_projek');

        return view('check_location.index', compact('tahunOptions'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'sta' => 'required|numeric',
            'tahun' => 'required|integer',
        ]);

        $staValue = $request->sta;
        $tahun = $request->tahun;

        $query = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])
            ->whereHas('projek', function ($q) use ($tahun) {
                $q->where('tahun_projek', $tahun);
            });

        $query->where(function ($q) use ($staValue) {
            $q->where('sta_awal', '<=', $staValue)
              ->where('sta_akhir', '>=', $staValue);
        });

        $sfoActivities = $query->get();

        if ($sfoActivities->isEmpty()) {
            return redirect()->route('check-location')
                ->with('error', 'Tidak ditemukan data SFO untuk STA ' . $staValue . ' pada tahun ' . $tahun . '.')
                ->withInput();
        }

        if ($sfoActivities->count() === 1) {
            return redirect()->route('check-location.detail', $sfoActivities->first()->id);
        }

        return view('check_location.results', compact('sfoActivities', 'staValue', 'tahun'));
    }

    public function detail($id)
    {
        $sfo = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])->findOrFail($id);

        return view('check_location.detail', compact('sfo'));
    }
}