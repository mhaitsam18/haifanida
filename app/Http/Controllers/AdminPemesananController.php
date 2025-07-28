<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paket $paket = null)
    {
        return view('admin.paket.pemesanan.index', [
            'title' => 'Data Pemesanan',
            'page' => 'pemesanan',
            'paket' => $paket,
            'pemesanans' => ($paket) ? $paket->pemesanans : Pemesanan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paket $paket = null)
    {
        return view('admin.paket.pemesanan.create', [
            'title' => 'Tambah Data Pemesanan',
            'page' => 'pemesanan',
            'paket' => $paket,
            'pakets' => Paket::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'user_id' => 'nullable|integer',
            // 'is_umroh' => 'nullable|integer',
            // 'is_haji' => 'nullable|integer',
            // 'is_wisata_halal' => 'nullable|integer',
            'status' => 'nullable|string',
            'tanggal_pesan' => 'nullable|date',
            // 'tanggal_berangkat' => 'nullable|date',
            'jumlah_orang' => 'nullable|numeric',
            'total_harga' => 'nullable|numeric',
            'metode_pembayaran' => 'nullable|string',
            'is_pembayaran_lunas' => 'nullable|integer',
            'tanggal_pelunasan' => 'nullable|date',
            // 'check_at_least_one' => 'required_without_all:is_umroh,is_haji,is_wisata_halal',
        ]);

        Pemesanan::create($validateData);
        return back()->with('success', 'Data Pemesanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        return view('admin.paket.pemesanan.show', [
            'title' => 'Detail Pemesanan',
            'page' => 'pemesanan',
            'pemesanan' => $pemesanan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        return view('admin.paket.pemesanan.edit', [
            'title' => 'Edit Pemesanan',
            'page' => 'pemesanan',
            'pemesanan' => $pemesanan,
            'pakets' => Paket::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {

        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'user_id' => 'nullable|integer',
            // 'is_umroh' => 'nullable|integer',
            // 'is_haji' => 'nullable|integer',
            // 'is_wisata_halal' => 'nullable|integer',
            'status' => 'nullable|string',
            'tanggal_pesan' => 'nullable|date',
            // 'tanggal_berangkat' => 'nullable|date',
            'jumlah_orang' => 'nullable|numeric',
            'total_harga' => 'nullable|numeric',
            'metode_pembayaran' => 'nullable|string',
            'is_pembayaran_lunas' => 'nullable|integer',
            'tanggal_pelunasan' => 'nullable|date',
            // 'check_at_least_one' => 'required_without_all:is_umroh,is_haji,is_wisata_halal',
        ]);

        $pemesanan->update($validateData);
        return back()->with('success', 'Data Pemesanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return back()->with('success', 'Data Pemesanan berhasil dihapus');
    }
}
