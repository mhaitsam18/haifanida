<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\KategoriCatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catatan = Catatan::with('kategori')->get();

        return view('admin.catatan.index', [
            // Kelompokkan berdasarkan kategori
            // dan mbil semua catatan kecuali untuk kategori jadwal_keberangkatan
            'kategoriCatatan' => $catatan->groupBy('kategori_catatan_id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idKategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idKategori)
    {
        return view('admin.catatan.edit', [
            'catatan' => Catatan::with('kategori')->where('kategori_catatan_id', $idKategori)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idKategori)
    {
        KategoriCatatan::where('id', $idKategori)->update([
            'nama' => $request->kategori,
            'kategori' => Str::snake($request->kategori),
        ]);

        Catatan::where('kategori_catatan_id',$idKategori)->delete();

        $input = $request->catatan;

        foreach ($input as $i) {
            Catatan::create([
                'kategori_catatan_id' => $idKategori,
                'catatan' => $i,
            ]);
        }

        $request->session()->flash('alert-class', 'success');
        $request->session()->flash('alert', ['Berhasil', 'Berhasil edit catatan']);
        return redirect()->route('admin.catatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idKategori)
    {
        //
    }
}
