<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kantor;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class AdminPerwakilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.perwakilan.index', [
            'title' => 'Data perwakilan',
            'page' => 'perwakilan',
            'perwakilans' => Kantor::where('jenis_kantor', 'perwakilan')->with('kabupaten')->paginate(200),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.perwakilan.create', [
            'title' => 'Tambah Perwakilan',
            'page' => 'perwakilan',
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatePerwakilan = $request->validate([
            'nama_kantor' => 'required',
            'nama_ketua' => 'required',
            'kontak_kantor' => 'nullable',
            'alamat_kantor' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'nullable',
            'kode_pos' => 'nullable',
            'surat_izin' => 'nullable',
        ]);
        $validatePerwakilan['jenis_kantor'] = 'perwakilan';
        Kantor::create($validatePerwakilan);
        return redirect('/admin/perwakilan')->with('success', 'Data Perwakilan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kantor $perwakilan)
    {
        abort_unless($perwakilan->jenis_kantor === 'perwakilan', 404);

        return view('admin.perwakilan.show', [
            'title' => 'Detail perwakilan',
            'page' => 'perwakilan',
            'perwakilan' => $perwakilan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kantor $perwakilan)
    {
        abort_unless($perwakilan->jenis_kantor === 'perwakilan', 404);

        return view('admin.perwakilan.edit', [
            'title' => 'Edit perwakilan',
            'page' => 'perwakilan',
            'perwakilan' => $perwakilan,
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kantor $perwakilan)
    {
        abort_unless($perwakilan->jenis_kantor === 'perwakilan', 404);

        $validatePerwakilan = $request->validate([
            'nama_kantor' => 'required',
            'nama_ketua' => 'required',
            'kontak_kantor' => 'nullable',
            'alamat_kantor' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'nullable',
            'kode_pos' => 'nullable',
            'surat_izin' => 'nullable',
        ]);
        $perwakilan->update($validatePerwakilan);
        return redirect('/admin/perwakilan')->with('success', 'Data Perwakilan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kantor $perwakilan)
    {
        abort_unless($perwakilan->jenis_kantor === 'perwakilan', 404);

        $perwakilan->delete();
        return redirect('/admin/perwakilan')->with('success', 'Data perwakilan berhasil dihapus');
    }
}
