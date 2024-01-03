<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kantor;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class AdminKantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kantor.index', [
            'title' => 'Data Kantor',
            'page' => 'kantor',
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kantor.create', [
            'title' => 'Tambah kantor',
            'page' => 'kantor',
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_kantor' => 'required',
            'nama_ketua' => 'required',
            'kontak_kantor' => 'nullable',
            'alamat_kantor' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'nullable',
            'kode_pos' => 'nullable',
            'jenis_kantor' => 'nullable',
        ]);
        Kantor::create($validateData);
        return redirect('/admin/kantor')->with('success', 'Data Kantor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kantor $kantor)
    {
        return view('admin.kantor.show', [
            'title' => 'Detail Kantor',
            'page' => 'kantor',
            'kantor' => $kantor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kantor $kantor)
    {
        return view('admin.kantor.edit', [
            'title' => 'Edit kantor',
            'page' => 'kantor',
            'kantor' => $kantor,
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kantor $kantor)
    {
        $validateData = $request->validate([
            'nama_kantor' => 'required',
            'nama_ketua' => 'required',
            'kontak_kantor' => 'nullable',
            'alamat_kantor' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'nullable',
            'kode_pos' => 'nullable',
            'jenis_kantor' => 'nullable',
        ]);
        $kantor->update($validateData);
        return redirect('/admin/kantor')->with('success', 'Data kantor berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kantor $kantor)
    {
        $kantor->delete();
        return redirect('/admin/kantor')->with('success', 'Data kantor berhasil dihapus');
    }
}
