<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SfoActivity;
use App\Models\Project;
use App\Models\Location;

class HomeController extends Controller
{
    public function index()
    {
        $jalurOptions = Location::distinct()->pluck('jalur');
        $tahunOptions = Project::distinct()->pluck('tahun_projek');
        return view('index', compact('jalurOptions', 'tahunOptions'));
    }

    public function checkLocation(Request $request)
    {
        $request->validate([
            'sta_awal' => 'required|integer',
            'sta_akhir' => 'required|integer',
            'jalur' => 'required|string',
            'tahun' => 'required|integer',
            'tanggal_sfo' => 'nullable|date'
        ]);

        $query = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])
            ->whereHas('projek', fn($q) => $q->where('tahun_projek', $request->tahun))
            ->whereHas('lokasi', fn($q) => $q->where('jalur', $request->jalur));

        $query->where(function ($q) use ($request) {
            $q->whereBetween('sta_awal', [$request->sta_awal, $request->sta_akhir])
                ->orWhereBetween('sta_akhir', [$request->sta_awal, $request->sta_akhir])
                ->orWhere(fn($q2) => $q2->where('sta_awal', '<=', $request->sta_awal)->where('sta_akhir', '>=', $request->sta_akhir));
        });

        if ($request->tanggal_sfo) {
            $query->whereDate('tanggal_sfo', $request->tanggal_sfo);
        }

        $sfo = $query->first();

        if (!$sfo) {
            return response()->json(['status' => 'not_found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'html' => view('partials.sfo_modal_content', compact('sfo'))->render()
        ]);
    }
}