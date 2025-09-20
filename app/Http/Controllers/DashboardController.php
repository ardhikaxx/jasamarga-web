<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SfoActivity;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik jalan sudah dan belum di-SFO
        // Hitung total panjang jalan dari data SFO yang ada (dalam meter)
        $totalSfoPanjang = SfoActivity::sum('panjang');
        
        // Asumsi total panjang jalan adalah maksimum dari total SFO atau 10 KM (10000 meter)
        $totalPanjangJalan = max($totalSfoPanjang, 10000);
        
        // Hitung persentase progress
        $progressPercentage = $totalPanjangJalan > 0 ? ($totalSfoPanjang / $totalPanjangJalan) * 100 : 0;
        
        // Konversi ke KM dan format dengan 1 desimal
        $jalanSudahSfo = number_format($totalSfoPanjang / 1000, 1, '.', '');
        $jalanBelumSfo = number_format(max(0, $totalPanjangJalan - $totalSfoPanjang) / 1000, 1, '.', '');
        
        // Data untuk grafik SFO per tahun
        $tahun = request('tahun', date('Y'));
        $grafikData = $this->getSfoChartData($tahun);
        
        return view('dashboard.index', compact(
            'jalanSudahSfo', 
            'jalanBelumSfo', 
            'grafikData', 
            'tahun',
            'progressPercentage',
            'totalPanjangJalan'
        ));
    }
    
    private function getSfoChartData($tahun)
    {
        // Query untuk mendapatkan data SFO per bulan pada tahun tertentu
        $sfoData = SfoActivity::select(
                DB::raw('MONTH(tanggal_sfo) as bulan'),
                DB::raw('SUM(panjang) as total_panjang')
            )
            ->whereYear('tanggal_sfo', $tahun)
            ->groupBy(DB::raw('MONTH(tanggal_sfo)'))
            ->orderBy(DB::raw('MONTH(tanggal_sfo)'))
            ->get();
        
        // Inisialisasi array untuk semua bulan (Jan-Dec)
        $bulanLabels = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOV', 'DES'];
        $bulanData = array_fill(0, 12, 0);
        
        // Isi data dari query ke array
        foreach ($sfoData as $data) {
            $index = $data->bulan - 1; // Konversi bulan (1-12) ke index array (0-11)
            if ($index >= 0 && $index < 12) {
                $bulanData[$index] = number_format($data->total_panjang / 1000, 1); // Konversi ke KM
            }
        }
        
        return [
            'labels' => $bulanLabels,
            'data' => $bulanData
        ];
    }
    
    // API endpoint untuk mendapatkan data grafik (jika diperlukan untuk AJAX)
    public function getChartData(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $grafikData = $this->getSfoChartData($tahun);
        
        return response()->json($grafikData);
    }
}