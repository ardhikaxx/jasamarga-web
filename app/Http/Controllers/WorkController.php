<?php

namespace App\Http\Controllers;

use App\Models\WorkType;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        $workTypes = WorkType::orderBy('nama_pekerjaan')->get();
        return view('work.index', compact('workTypes'));
    }

    public function create()
    {
        return view('work.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255|unique:work_types,nama_pekerjaan',
            'deskripsi' => 'nullable|string|max:1000'
        ]);

        WorkType::create($request->all());

        return redirect()->route('work.index')
            ->with('success', 'Jenis pekerjaan berhasil ditambahkan.');
    }

    public function show(WorkType $work)
    {
        return view('work.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkType $work)
    {
        return view('work.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkType $work)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255|unique:work_types,nama_pekerjaan,' . $work->id,
            'deskripsi' => 'nullable|string|max:1000'
        ]);

        $work->update($request->all());

        return redirect()->route('work.index')
            ->with('success', 'Jenis pekerjaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkType $work)
    {
        // Check if work type has related activities
        if ($work->aktivitasSfo()->count() > 0) {
            return redirect()->route('work.index')
                ->with('error', 'Tidak dapat menghapus jenis pekerjaan karena memiliki aktivitas SFO terkait.');
        }

        $work->delete();

        return redirect()->route('work.index')
            ->with('success', 'Jenis pekerjaan berhasil dihapus.');
    }
}