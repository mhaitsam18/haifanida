<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use Illuminate\Http\Request;

class AdminEkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.ekstra.index', [
            'title' => 'Master Data Ekstra',
            'page' => 'ekstra',
            'ekstras' => Ekstra::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ekstra.create', [
            'title' => 'Tambah ekstra',
            'page' => 'ekstra',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_ekstra' => 'required|string',
            'harga_default' => 'nullable|integer',
            'jenis_ekstra' => 'nullable|string|in:perlengkapan,jasa,permintaan_kamar,tipe_kamar,pesawat',
            'deskripsi' => 'nullable|string',
        ]);

        Ekstra::create($validateData);
        return redirect('/admin/ekstra')->with('success', 'Data ekstra berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ekstra $ekstra)
    {
        return view('admin.ekstra.show', [
            'title' => 'Detail ekstra',
            'page' => 'ekstra',
            'ekstra' => $ekstra,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstra $ekstra)
    {
        return view('admin.ekstra.edit', [
            'title' => 'Edit ekstra',
            'page' => 'ekstra',
            'ekstra' => $ekstra,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstra $ekstra)
    {
        $validateData = $request->validate([
            'nama_ekstra' => 'required|string',
            'harga_default' => 'nullable|integer',
            'jenis_ekstra' => 'nullable|string|in:perlengkapan,jasa,permintaan_kamar,tipe_kamar,pesawat',
            'deskripsi' => 'nullable|string',
        ]);
        $ekstra->update($validateData);
        return redirect('/admin/ekstra')->with('success', 'Data ekstra berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstra $ekstra)
    {
        $ekstra->delete();
        return redirect('/admin/ekstra')->with('success', 'Data ekstra berhasil dihapus');
    }
}
