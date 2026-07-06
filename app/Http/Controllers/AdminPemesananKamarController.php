<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use App\Models\Pemesanan;
use App\Models\PemesananKamar;
use Illuminate\Http\Request;

class AdminPemesananKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pemesanan $pemesanan = null)
    {
        return view('admin.paket.pemesanan.pemesanan-kamar.index', [
            'title' => 'Pemesanan Kamar',
            'page' => 'pemesanan-kamar',
            'pemesanan' => $pemesanan,
            'pemesananKamars' => ($pemesanan) ? $pemesanan->pemesananKamars()->paginate(200) : PemesananKamar::paginate(200),
            'pemesanans' => Pemesanan::all(),
            'kamars' => Ekstra::where('jenis_ekstra', 'tipe kamar')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'tipe_kamar' => 'required|string',
            'jumlah_pengisi' => 'required|numeric',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        PemesananKamar::create($validateData);
        return back()->with('success', 'Pemesanan Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PemesananKamar $pemesananKamar)
    {
        return view('admin.paket.pemesanan.pemesanan-kamar.show', [
            'title' => 'Detail Pemesanan Kamar',
            'page' => 'pemesanan-kamar',
            'pemesananKamar' => $pemesananKamar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemesananKamar $pemesananKamar)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'tipe_kamar' => 'required|string',
            'jumlah_pengisi' => 'required|numeric',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $pemesananKamar->update($validateData);
        return back()->with('success', 'Pemesanan Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemesananKamar $pemesananKamar)
    {
        $pemesananKamar->delete();
        return back()->with('success', 'Pemesanan Kamar berhasil dihapus');
    }
}
