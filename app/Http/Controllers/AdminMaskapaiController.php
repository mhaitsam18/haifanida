<?php

namespace App\Http\Controllers;

use App\Models\Maskapai;
use Illuminate\Http\Request;

class AdminMaskapaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.maskapai.index', [
            'title' => 'Data Maskapai',
            'page' => 'maskapai',
            'maskapais' => Maskapai::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.maskapai.create', [
            'title' => 'Tambah Maskapai',
            'page' => 'maskapai',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_maskapai' => 'required|unique:maskapai',
            'nama_maskapai' => 'required|string',
            'negara_asal' => 'required|integer',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'deskripsi' => 'nullable|string',
        ]);
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('maskapai-logo');
            $validateData['logo'] = $path;
        }

        Maskapai::create($validateData);
        return redirect('/admin/maskapai')->with('success', 'Data Maskapai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maskapai $maskapai)
    {
        return view('admin.maskapai.show', [
            'title' => 'Detail Maskapai',
            'page' => 'maskapai',
            'maskapai' => $maskapai,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maskapai $maskapai)
    {
        return view('admin.maskapai.edit', [
            'title' => 'Edit Maskapai',
            'page' => 'maskapai',
            'maskapai' => $maskapai,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maskapai $maskapai)
    {
        $validateData = $request->validate([
            'kode_maskapai' => 'required|unique:maskapais,kode_maskapai,' . $maskapai->id,
            'nama_maskapai' => 'required|string',
            'negara_asal' => 'required|integer',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('maskapai-logo');
            $validateData['logo'] = $path;
        } else {
            $validateData['logo'] = $maskapai->logo;
        }

        $maskapai->update($validateData);

        return redirect('/admin/maskapai')->with('success', 'Data Maskapai berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maskapai $maskapai)
    {
        $maskapai->delete();
        return redirect('/admin/maskapai')->with('success', 'Data Maskapai berhasil dihapus');
    }
}
