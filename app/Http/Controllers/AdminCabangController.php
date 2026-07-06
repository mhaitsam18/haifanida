<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kantor;
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
            'cabangs' => Kantor::where('jenis_kantor', 'cabang')->with(['kabupaten', 'indukKantor'])->paginate(200),
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'perwakilans' => Kantor::where('jenis_kantor', 'perwakilan')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateCabang = $request->validate([
            'induk_kantor_id' => 'nullable',
            'nama_kantor' => 'required',
            'nama_ketua' => 'required',
            'kontak_kantor' => 'nullable',
            'alamat_kantor' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'nullable',
            'kode_pos' => 'nullable',
            'surat_izin' => 'nullable',
        ]);
        $validateCabang['jenis_kantor'] = 'cabang';
        Kantor::create($validateCabang);
        return redirect('/admin/cabang')->with('success', 'Data cabang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kantor $cabang)
    {
        abort_unless($cabang->jenis_kantor === 'cabang', 404);

        return view('admin.cabang.show', [
            'title' => 'Detail Cabang',
            'page' => 'cabang',
            'cabang' => $cabang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kantor $cabang)
    {
        abort_unless($cabang->jenis_kantor === 'cabang', 404);

        $validateCabang = $request->validate([
            'induk_kantor_id' => 'nullable',
            'nama_kantor' => 'required',
            'nama_ketua' => 'required',
            'kontak_kantor' => 'nullable',
            'alamat_kantor' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'nullable',
            'kode_pos' => 'nullable',
            'surat_izin' => 'nullable',
        ]);
        $cabang->update($validateCabang);
        return redirect('/admin/cabang')->with('success', 'Data Cabang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kantor $cabang)
    {
        abort_unless($cabang->jenis_kantor === 'cabang', 404);

        $cabang->delete();
        return redirect('/admin/cabang')->with('success', 'Data cabang berhasil dihapus');
    }
}
