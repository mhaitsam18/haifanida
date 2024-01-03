<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Kabupaten;
use App\Models\Kantor;
use App\Models\Perwakilan;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class AdminCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cabang.index', [
            'title' => 'Data cabang',
            'page' => 'cabang',
            'cabangs' => Cabang::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cabang.create', [
            'title' => 'Tambah cabang',
            'page' => 'cabang',
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'kantors' => Kantor::all(),
            'perwakilans' => Perwakilan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateCabang = $request->validate([
            'kantor_id' => 'nullable',
            'perwakilan_id' => 'nullable',
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
            $validateCabang['kantor_id'] = $kantor->id;
        }
        Cabang::create($validateCabang);
        return redirect('/admin/cabang')->with('success', 'Data cabang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
        return view('admin.cabang.show', [
            'title' => 'Detail Cabang',
            'page' => 'cabang',
            'cabang' => $cabang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
        return view('admin.cabang.edit', [
            'title' => 'Edit cabang',
            'page' => 'cabang',
            'cabang' => $cabang,
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'kantors' => Kantor::all(),
            'perwakilans' => Perwakilan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $validateCabang = $request->validate([
            'kantor_id' => 'nullable',
            'perwakilan_id' => 'nullable',
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
            $validateCabang['kantor_id'] = $kantor->id;
        }
        $cabang->update($validateCabang);
        return redirect('/admin/cabang')->with('success', 'Data Cabang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        $cabang->delete();
        return redirect('/admin/cabang')->with('success', 'Data cabang berhasil dihapus');
    }
}
