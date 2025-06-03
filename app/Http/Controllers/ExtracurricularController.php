<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    // Menampilkan semua ekstrakurikuler
    public function index()
    {
        $extracurriculars = Extracurricular::latest()->paginate(10);
        return view('extracurriculars.index', compact('extracurriculars'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('extracurriculars.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'responsible_person' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif'
        ]);

        Extracurricular::create($request->all());

        return redirect()->route('extracurriculars.index')
                         ->with('success', 'Ekstrakurikuler berhasil ditambahkan');
    }

    // Menampilkan detail
    public function show(Extracurricular $extracurricular)
    {
        return view('extracurriculars.show', compact('extracurricular'));
    }

    // Menampilkan form edit
    public function edit(Extracurricular $extracurricular)
    {
        return view('extracurriculars.edit', compact('extracurricular'));
    }

    // Update data
    public function update(Request $request, Extracurricular $extracurricular)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'responsible_person' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif'
        ]);

        $extracurricular->update($request->all());

        return redirect()->route('extracurriculars.index')
                         ->with('success', 'Data ekstrakurikuler berhasil diperbarui');
    }

    // Hapus data
    public function destroy(Extracurricular $extracurricular)
    {
        $extracurricular->delete();

        return redirect()->route('extracurriculars.index')
                         ->with('success', 'Ekstrakurikuler berhasil dihapus');
    }
}