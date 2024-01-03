<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kantor;
use App\Models\Perwakilan;
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
            'perwakilans' => Perwakilan::all(),
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
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatePerwakilan = $request->validate([
            'kantor_id' => 'nullable',
            'nama_ketua' => 'required',
            'kontak' => 'nullable',
            'surat_izin' => 'nullable'
        ]);
        if (!$request->kantor_id) {
            $validateKantor = $request->validate([
                'nama_kantor' => 'required',
                'nama_ketua' => 'required',
                'kontak_kantor' => 'nullable',
                'alamat_kantor' => 'required',
                'kabupaten_id' => 'required',
                'kecamatan' => 'nullable',
                'kode_pos' => 'nullable',
                'jenis_kantor' => 'nullable',
            ]);
            $kantor = Kantor::create($validateKantor);
            $validatePerwakilan['kantor_id'] = $kantor->id;
        }
        Perwakilan::create($validatePerwakilan);
        return redirect('/admin/perwakilan')->with('success', 'Data Perwakilan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Perwakilan $perwakilan)
    {
        return view('admin.perwakilan.show', [
            'title' => 'Detail perwakilan',
            'page' => 'perwakilan',
            'perwakilan' => $perwakilan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perwakilan $perwakilan)
    {
        return view('admin.perwakilan.edit', [
            'title' => 'Edit perwakilan',
            'page' => 'perwakilan',
            'perwakilan' => $perwakilan,
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perwakilan $perwakilan)
    {
        $validatePerwakilan = $request->validate([
            'kantor_id' => 'nullable',
            'nama_ketua' => 'required',
            'kontak' => 'nullable',
            'surat_izin' => 'nullable'
        ]);
        if (!$request->kantor_id) {
            $validateKantor = $request->validate([
                'nama_kantor' => 'required',
                'nama_ketua' => 'required',
                'kontak_kantor' => 'nullable',
                'alamat_kantor' => 'required',
                'kabupaten_id' => 'required',
                'kecamatan' => 'nullable',
                'kode_pos' => 'nullable',
                'jenis_kantor' => 'nullable',
            ]);
            $kantor = Kantor::create($validateKantor);
            $validatePerwakilan['kantor_id'] = $kantor->id;
        }
        $perwakilan->update($validatePerwakilan);
        return redirect('/admin/perwakilan')->with('success', 'Data Perwakilan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perwakilan $perwakilan)
    {
        $perwakilan->delete();
        return redirect('/admin/perwakilan')->with('success', 'Data perwakilan berhasil dihapus');
    }
}
