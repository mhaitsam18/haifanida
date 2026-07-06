<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            'berkass' => Berkas::paginate(200),
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
        Cache::forget('berkas.all');
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
        Cache::forget('berkas.all');
        return redirect('/admin/berkas')->with('success', 'Data berkas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berkas $berkas)
    {
        $berkas->delete();
        Cache::forget('berkas.all');
        return redirect('/admin/berkas')->with('success', 'Data berkas berhasil dihapus');
    }
}
