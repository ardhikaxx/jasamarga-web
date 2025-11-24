<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_projek' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tahun_projek' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5)
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Projek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'nama_projek' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tahun_projek' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5)
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Projek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Projek berhasil dihapus.');
    }
}