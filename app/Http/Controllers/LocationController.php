<?php

namespace App\Http\Controllers;

use App\Models\Sfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LocationController extends Controller
{
    // /**
    //  * Show the input form
    //  */
    // public function showInputForm()
    // {
    //     $jalurOptions = Sfo::getJalurOptions();
    //     return view('location.input', compact('jalurOptions'));
    // }

    // /**
    //  * Show the check form
    //  */
    // public function showCheckForm()
    // {
    //     $jalurOptions = Sfo::getJalurOptions();
    //     return view('location.check', compact('jalurOptions'));
    // }

    // /**
    //  * Process location check
    //  */
    // public function checkLocation(Request $request)
    // {
    //     // Validasi data
    //     $validator = Validator::make($request->all(), [
    //         'lokasi_awal' => 'required|string|max:255',
    //         'lokasi_akhir' => 'required|string|max:255',
    //         'jalur_sfo' => 'required|string|max:255',
    //         'tahun' => 'required|integer|min:2000|max:' . date('Y'),
    //     ], [
    //         'lokasi_awal.required' => 'Lokasi awal harus diisi',
    //         'lokasi_akhir.required' => 'Lokasi akhir harus diisi',
    //         'jalur_sfo.required' => 'Jalur SFO harus diisi',
    //         'tahun.required' => 'Tahun harus diisi',
    //         'tahun.integer' => 'Tahun harus berupa angka',
    //         'tahun.min' => 'Tahun tidak valid',
    //         'tahun.max' => 'Tahun tidak boleh melebihi tahun saat ini',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     try {
    //         // Cari data SFO berdasarkan kriteria
    //         $sfo = Sfo::where('lokasi_awal', 'like', '%' . $request->lokasi_awal . '%')
    //             ->where('lokasi_akhir', 'like', '%' . $request->lokasi_akhir . '%')
    //             ->where('jalur_sfo', $request->jalur_sfo)
    //             ->whereYear('tanggal_sfo', $request->tahun)
    //             ->first();

    //         if ($sfo) {
    //             // Jika data ditemukan, redirect ke halaman detail dengan data SFO
    //             return redirect()->route('location-sfo', ['id' => $sfo->id]);
    //         } else {
    //             // Jika data tidak ditemukan, kembali dengan pesan error
    //             return redirect()->back()
    //                 ->with('error', 'Data SFO tidak ditemukan dengan kriteria yang diberikan')
    //                 ->withInput();
    //         }

    //     } catch (\Exception $e) {
    //         return redirect()->back()
    //             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }

    // /**
    //  * Show SFO details
    //  */
    // public function showSfoDetails($id)
    // {
    //     try {
    //         $sfo = Sfo::findOrFail($id);
    //         return view('location.detail', compact('sfo'));
    //     } catch (\Exception $e) {
    //         return redirect()->route('check-location')
    //             ->with('error', 'Data SFO tidak ditemukan');
    //     }
    // }

    // /**
    //  * Store SFO data
    //  */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'lokasi_awal' => 'required|string|max:255',
    //         'lokasi_akhir' => 'required|string|max:255',
    //         'posisi_awal' => 'required|string|max:255',
    //         'posisi_akhir' => 'required|string|max:255',
    //         'panjang' => 'required|numeric|min:0',
    //         'lebar' => 'required|numeric|min:0',
    //         'tebal' => 'required|numeric|min:0',
    //         'luas' => 'required|numeric|min:0',
    //         'tanggal_sfo' => 'required|date',
    //         'jalur_sfo' => 'required|string|max:255',
    //         'keterangan' => 'nullable|string',
    //     ], [
    //         'lokasi_awal.required' => 'Lokasi awal harus diisi',
    //         'lokasi_akhir.required' => 'Lokasi akhir harus diisi',
    //         'posisi_awal.required' => 'Posisi jalur awal harus diisi',
    //         'posisi_akhir.required' => 'Posisi jalur akhir harus diisi',
    //         'panjang.required' => 'Panjang harus diisi',
    //         'lebar.required' => 'Lebar harus diisi',
    //         'tebal.required' => 'Tebal harus diisi',
    //         'luas.required' => 'Luas harus diisi',
    //         'tanggal_sfo.required' => 'Tanggal SFO harus diisi',
    //         'jalur_sfo.required' => 'Jalur SFO harus diisi',
    //         'panjang.numeric' => 'Panjang harus berupa angka',
    //         'lebar.numeric' => 'Lebar harus berupa angka',
    //         'tebal.numeric' => 'Tebal harus berupa angka',
    //         'luas.numeric' => 'Luas harus berupa angka',
    //         'panjang.min' => 'Panjang tidak boleh negatif',
    //         'lebar.min' => 'Lebar tidak boleh negatif',
    //         'tebal.min' => 'Tebal tidak boleh negatif',
    //         'luas.min' => 'Luas tidak boleh negatif',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     try {
    //         $sfo = Sfo::create([
    //             'lokasi_awal' => $request->lokasi_awal,
    //             'lokasi_akhir' => $request->lokasi_akhir,
    //             'posisi_awal' => $request->posisi_awal,
    //             'posisi_akhir' => $request->posisi_akhir,
    //             'panjang' => $request->panjang,
    //             'lebar' => $request->lebar,
    //             'tebal' => $request->tebal,
    //             'luas' => $request->luas,
    //             'tanggal_sfo' => $request->tanggal_sfo,
    //             'jalur_sfo' => $request->jalur_sfo,
    //             'keterangan' => $request->keterangan,
    //             'status' => Sfo::STATUS_UNPROCESSED,
    //         ]);

    //         $formattedDate = Carbon::parse($request->tanggal_sfo)->locale('id')->translatedFormat('d F Y');

    //         return redirect()->route('input-location')
    //             ->with('success', 'Data SFO berhasil disimpan!')
    //             ->with('sfo_date', $formattedDate);

    //     } catch (\Exception $e) {
    //         return redirect()->back()
    //             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }
}