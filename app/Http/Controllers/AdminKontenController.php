<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;

class AdminKontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.konten.index', [
            'title' => 'Data konten',
            'page' => 'konten',
            'kontens' => Konten::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.konten.create', [
            'title' => 'Data konten',
            'page' => 'konten',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'nullable',
            'judul' => 'required',
            'isi_konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('konten-gambar');
            $validateData['gambar'] = $path;
        }
        Konten::create($validateData);
        return redirect('/admin/konten')->with('success', 'Data Konten berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Konten $konten)
    {
        return view('admin.konten.show', [
            'title' => 'Detail Konten',
            'page' => 'konten',
            'konten' => $konten,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konten $konten)
    {
        return view('admin.konten.edit', [
            'title' => 'Ubah Konten',
            'page' => 'konten',
            'konten' => $konten,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konten $konten)
    {
        $validateData = $request->validate([
            'user_id' => 'nullable',
            'judul' => 'required',
            'isi_konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('konten-gambar');
            $validateData['gambar'] = $path;
        } else {
            $validateData['gambar'] = $konten->gambar;
        }
        $konten->update($validateData);
        return redirect('/admin/konten')->with('success', 'Data Konten berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konten $konten)
    {
        $konten->delete();
        return redirect('/admin/konten')->with('success', 'Data Konten berhasil dihapus');
    }
}
