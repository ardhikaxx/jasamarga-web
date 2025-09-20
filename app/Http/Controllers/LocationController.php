<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan pagination dengan 10 data per halaman
        $locations = Location::orderBy('jalur')->orderBy('lajur')->paginate(10);
        return view('lokasi_jalur_lajur.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lokasi_jalur_lajur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jalur' => 'required|string|max:255',
            'lajur' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500'
        ]);

        // Check if combination already exists
        $existing = Location::where('jalur', $request->jalur)
                            ->where('lajur', $request->lajur)
                            ->first();
        
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kombinasi jalur dan lajur sudah ada.');
        }

        Location::create($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return view('lokasi_jalur_lajur.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('lokasi_jalur_lajur.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'jalur' => 'required|string|max:255',
            'lajur' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500'
        ]);

        // Check if combination already exists (excluding current location)
        $existing = Location::where('jalur', $request->jalur)
                            ->where('lajur', $request->lajur)
                            ->where('id', '!=', $location->id)
                            ->first();
        
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kombinasi jalur dan lajur sudah ada.');
        }

        $location->update($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Lokasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        // Check if location has related activities
        if ($location->aktivitasSfo()->count() > 0) {
            return redirect()->route('locations.index')
                ->with('error', 'Tidak dapat menghapus lokasi karena memiliki aktivitas SFO terkait.');
        }

        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Lokasi berhasil dihapus.');
    }
}