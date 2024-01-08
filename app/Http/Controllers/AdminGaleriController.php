<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Paket;
use Illuminate\Http\Request;

class AdminGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paket $paket = null)
    {
        return view('admin.paket.galeri.index', [
            'title' => 'Data galeri',
            'page' => 'galeri',
            'paket' => $paket,
            'galeries' => ($paket) ? $paket->galeries : galeri::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paket $paket = null)
    {
        return view('admin.paket.galeri.create', [
            'title' => 'Tambah Data galeri',
            'page' => 'galeri',
            'paket' => $paket,
            'pakets' => Paket::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'nama' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'jenis' => 'nullable|string',
        ]);

        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('paket-galeri');
            $validateData['file_path'] = $path;
        }

        Galeri::create($validateData);
        return back()->with('success', 'Data Galeri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        return view('admin.paket.galeri.show', [
            'title' => 'Detail galeri',
            'page' => 'galeri',
            'galeri' => $galeri,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.paket.galeri.edit', [
            'title' => 'Edit galeri',
            'page' => 'galeri',
            'galeri' => $galeri,
            'pakets' => Paket::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'nama' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'jenis' => 'nullable|string',
        ]);

        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('paket-galeri');
            $validateData['file_path'] = $path;
        } else {
            $validateData['file_path'] = $galeri->file_path;
        }

        $galeri->update($validateData);
        return back()->with('success', 'Data galeri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return back()->with('success', 'Data galeri berhasil dihapus');
    }
}
