<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;

class AdminBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.berkas.index', [
            'title' => 'Data berkas',
            'page' => 'berkas',
            'berkass' => Berkas::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berkas.create', [
            'title' => 'Tambah berkas',
            'page' => 'berkas',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_berkas' => 'required|string',
        ]);
        berkas::create([
            'nama_berkas' => $request->nama_berkas,
        ]);
        return redirect('/admin/berkas')->with('success', 'Data berkas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berkas $berkas)
    {
        return view('admin.berkas.show', [
            'title' => 'Detail berkas',
            'page' => 'berkas',
            'berkas' => $berkas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berkas $berkas)
    {
        return view('admin.berkas.edit', [
            'title' => 'Edit berkas',
            'page' => 'berkas',
            'berkas' => $berkas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berkas $berkas)
    {
        $request->validate([
            'nama_berkas' => 'required',
        ]);
        $berkas->update([
            'nama_berkas' => $request->nama_berkas,
        ]);
        return redirect('/admin/berkas')->with('success', 'Data berkas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berkas $berkas)
    {
        $berkas->delete();
        return redirect('/admin/berkas')->with('success', 'Data berkas berhasil dihapus');
    }
}
