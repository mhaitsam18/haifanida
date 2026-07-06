<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use App\Models\Pemesanan;
use App\Models\PemesananEkstra;
use Illuminate\Http\Request;

class AdminPemesananEkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pemesanan $pemesanan = null)
    {
        return view('admin.paket.pemesanan.pemesanan-ekstra.index', [
            'title' => 'Pemesanan ekstra',
            'page' => 'pemesanan-ekstra',
            'pemesanan' => $pemesanan,
            'pemesananEkstras' => ($pemesanan) ? $pemesanan->pemesananEkstras()->paginate(200) : PemesananEkstra::paginate(200),
            'pemesanans' => Pemesanan::all(),
            'ekstras' => Ekstra::whereNotIn('jenis_ekstra', ['tipe kamar', 'permintaan kamar'])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'ekstra' => 'required|string',
            'jumlah' => 'required|numeric',
            'total_harga' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        PemesananEkstra::create($validateData);
        return back()->with('success', 'Pemesanan Ekstra berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PemesananEkstra $pemesananEkstra)
    {
        return view('admin.paket.pemesanan.pemesanan-ekstra.show', [
            'title' => 'Pemesanan ekstra',
            'page' => 'pemesanan-ekstra',
            'pemesananEkstra' => $pemesananEkstra,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemesananEkstra $pemesananEkstra)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'ekstra' => 'required|string',
            'jumlah' => 'required|numeric',
            'total_harga' => 'required|numeric',
            'keterangan' => 'required|string',
        ]);

        $pemesananEkstra->update($validateData);
        return back()->with('success', 'Pemesanan Ekstra berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemesananEkstra $pemesananEkstra)
    {
        $pemesananEkstra->delete();
        return back()->with('success', 'Pemesanan Ekstra berhasil dihapus');
    }
}
