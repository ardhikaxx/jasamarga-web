<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SfoActivity;
use App\Models\Project;
use App\Models\Location;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $tahunOptions = Project::distinct()->pluck('tahun_projek');
        return view('index', compact('tahunOptions'));
    }

    public function checkLocation(Request $request)
    {
        try {
            $request->validate([
                'kilometer' => 'required|numeric|min:0',
                'tahun' => 'required|integer',
            ]);

            $kilometer = $request->kilometer;
            $tahun = $request->tahun;

            // Konversi kilometer ke meter (STA) - jika input kilometer
            // Jika input langsung STA, tidak perlu konversi
            $staValue = $kilometer;

            // Debug log
            Log::info('Pencarian SFO:', [
                'input' => $kilometer,
                'tahun' => $tahun,
                'sta_value' => $staValue
            ]);

            // Query untuk mencari data SFO yang sesuai dengan STA
            $query = SfoActivity::with([
                'projek' => function($q) use ($tahun) {
                    $q->where('tahun_projek', $tahun);
                },
                'lokasi',
                'jenisPekerjaan'
            ])->whereHas('projek', function ($q) use ($tahun) {
                $q->where('tahun_projek', $tahun);
            });

            // Filter berdasarkan STA - mencari SFO yang:
            // 1. STA awal sama dengan input
            // 2. STA akhir sama dengan input  
            // 3. Input berada dalam range STA awal - STA akhir
            $query->where(function ($q) use ($staValue) {
                $q->where('sta_awal', '=', $staValue)
                  ->orWhere('sta_akhir', '=', $staValue)
                  ->orWhere(function ($q2) use ($staValue) {
                      $q2->where('sta_awal', '<=', $staValue)
                         ->where('sta_akhir', '>=', $staValue);
                  });
            });

            $sfoActivities = $query->get();

            // Debug log hasil query
            Log::info('Hasil Pencarian SFO:', [
                'jumlah_data' => $sfoActivities->count(),
                'sta_value' => $staValue,
                'tahun' => $tahun,
                'data' => $sfoActivities->map(function($item) {
                    return [
                        'id' => $item->id,
                        'sta_awal' => $item->sta_awal,
                        'sta_akhir' => $item->sta_akhir,
                        'projek' => $item->projek ? $item->projek->nama_projek : 'null',
                        'tahun_projek' => $item->projek ? $item->projek->tahun_projek : 'null'
                    ];
                })->toArray()
            ]);

            if ($sfoActivities->isEmpty()) {
                return response()->json([
                    'status' => 'not_found',
                    'message' => 'Tidak ditemukan data SFO untuk STA ' . number_format($staValue) . ' pada tahun ' . $tahun . '.'
                ], 404);
            }

            // Jika hanya ditemukan satu data, langsung tampilkan detail
            if ($sfoActivities->count() === 1) {
                return response()->json([
                    'status' => 'single',
                    'html' => view('partials.sfo_modal_content', ['sfo' => $sfoActivities->first()])->render()
                ]);
            }

            // Jika ditemukan multiple data, tampilkan pilihan
            return response()->json([
                'status' => 'multiple',
                'html' => view('partials.sfo_results_modal', compact('sfoActivities', 'kilometer', 'tahun', 'staValue'))->render(),
                'count' => $sfoActivities->count(),
                'debug' => [
                    'sta_value' => $staValue,
                    'tahun' => $tahun,
                    'found_count' => $sfoActivities->count()
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error in checkLocation: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSfoDetail($id)
    {
        try {
            $sfo = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])->find($id);

            if (!$sfo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data SFO tidak ditemukan.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'html' => view('partials.sfo_modal_content', compact('sfo'))->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getSfoDetail: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}