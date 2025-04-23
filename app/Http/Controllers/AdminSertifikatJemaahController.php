<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\SertifikatJemaah;
use Illuminate\Http\Request;

class AdminSertifikatJemaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Jemaah $jemaah = null)
    {
        return view('admin.paket.jemaah.sertifikat.index', [
            'title' => "sertifikat Jema'ah",
            'page' => 'sertifikat-jemaah',
            'sertifikatJemaahs' => $jemaah ? sertifikatJemaah::where('jemaah_id', $jemaah->id)->get() : sertifikatJemaah::all(),
            'jemaah' => $jemaah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Jemaah $jemaah = null)
    {
        return view('admin.paket.jemaah.sertifikat.create', [
            'title' => 'Tambah sertifikat',
            'page' => 'sertifikat-jemaah',
            'jemaah' => $jemaah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jemaah_id' => 'required|integer',
            'nomor_sertifikat' => 'required|string',
            'tanggal_penerbitan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'jenis_sertifikat' => 'nullable|string',
            'sertifikat' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
        ]);
        if ($request->hasFile('sertifikat')) {
            $path = $request->file('sertifikat')->store('jemaah-sertifikat');
            $validateData['sertifikat'] = $path;
        }

        sertifikatJemaah::create($validateData);
        return back()->with('success', 'Data sertifikat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SertifikatJemaah $sertifikatJemaah)
    {
        return view('admin.paket.jemaah.sertifikat.show', [
            'title' => 'Lihat sertifikat',
            'page' => 'sertifikat-jemaah',
            'sertifikatJemaah' => $sertifikatJemaah,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SertifikatJemaah $sertifikatJemaah)
    {
        return view('admin.paket.jemaah.sertifikat.edit', [
            'title' => 'Edit Data sertifikat',
            'page' => 'sertifikat-jemaah',
            'sertifikatJemaah' => $sertifikatJemaah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SertifikatJemaah $sertifikatJemaah)
    {
        $validateData = $request->validate([
            'jemaah_id' => 'required|integer',
            'nomor_sertifikat' => 'required|string',
            'tanggal_penerbitan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'jenis_sertifikat' => 'nullable|string',
            'sertifikat' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
        ]);
        if ($request->hasFile('sertifikat')) {
            $path = $request->file('sertifikat')->store('jemaah-sertifikat');
            $validateData['sertifikat'] = $path;
        } else {
            $validateData['sertifikat'] = $sertifikatJemaah->sertifikat;
        }

        $sertifikatJemaah->update($validateData);
        return back()->with('success', "sertifikat Jema'ah berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SertifikatJemaah $sertifikatJemaah)
    {
        $sertifikatJemaah->delete();
        return back()->with('success', 'Data sertifikat Jemaah berhasil dihapus');
    }
}
