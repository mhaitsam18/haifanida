<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use App\Models\PemesananKamar;
use App\Models\PermintaanKamar;
use Illuminate\Http\Request;

class AdminPermintaanKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemesananKamar $pemesananKamar = null)
    {
        return view('admin.paket.pemesanan.pemesanan-kamar.permintaan-kamar.index', [
            'title' => 'Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'pemesananKamar' => $pemesananKamar,
            'permintaanKamars' => ($pemesananKamar) ? $pemesananKamar->permintaans : PermintaanKamar::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PemesananKamar $pemesananKamar = null)
    {
        return view('admin.paket.pemesanan.pemesanan-kamar.permintaan-kamar.create', [
            'title' => 'Tambah Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'pemesananKamar' => $pemesananKamar,
            'permintaanKamars' => PemesananKamar::all(),
            'permintaans' => Ekstra::where('jenis_ekstra', 'permintaan kamar')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'pemesanan_kamar_id' => 'required|integer',
            'permintaan' => 'required|string',
            'harga' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->permintaan_khusus) {
            $validateData['permintaan'] = $request->permintaan_khusus;
        }

        PermintaanKamar::create($validateData);
        return back()->with('success', 'Permintaan Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PermintaanKamar $permintaanKamar)
    {
        return view('admin.paket.pemesanan.pemesanan-kamar.permintaan-kamar.show', [
            'title' => 'Detail Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'permintaanKamar' => $permintaanKamar,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermintaanKamar $permintaanKamar)
    {
        return view('admin.paket.pemesanan.pemesanan-kamar.permintaan-kamar.edit', [
            'title' => 'Edit Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'permintaanKamar' => $permintaanKamar,
            'pemesananKamars' => PemesananKamar::all(),
            'permintaans' => Ekstra::where('jenis_ekstra', 'permintaan kamar')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PermintaanKamar $permintaanKamar)
    {
        $validateData = $request->validate([
            'pemesanan_kamar_id' => 'required|integer',
            'permintaan' => 'required|string',
            'harga' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->permintaan_khusus) {
            $validateData['permintaan'] = $request->permintaan_khusus;
        }

        $permintaanKamar->update($validateData);
        return back()->with('success', 'Permintaan Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermintaanKamar $permintaanKamar)
    {

        $permintaanKamar->delete();
        return back()->with('success', 'Permintaan Kamar berhasil dihapus');
    }
}
