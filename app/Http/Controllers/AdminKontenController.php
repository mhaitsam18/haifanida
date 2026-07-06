<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            'kontens' => Konten::with('user')->paginate(200),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'nullable',
            'nama' => 'required',
            'judul' => 'required',
            'isi_konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('konten-gambar');
            $validateData['gambar'] = $path;
        }
        Konten::create($validateData);
        Cache::forget('konten.all');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konten $konten)
    {
        $validateData = $request->validate([
            'user_id' => 'nullable',
            'nama' => 'required',
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
        Cache::forget('konten.all');
        return redirect('/admin/konten')->with('success', 'Data Konten berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konten $konten)
    {
        $konten->delete();
        Cache::forget('konten.all');
        return redirect('/admin/konten')->with('success', 'Data Konten berhasil dihapus');
    }
}
