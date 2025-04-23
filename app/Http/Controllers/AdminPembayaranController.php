<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pemesanan $pemesanan = null)
    {
        return view('admin.paket.pemesanan.pembayaran.index', [
            'title' => 'Riwayat Pembayaran',
            'page' => 'pembayaran',
            'pemesanan' => $pemesanan,
            'pembayarans' => ($pemesanan) ? $pemesanan->pembayarans : Pembayaran::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pemesanan $pemesanan = null)
    {
        return view('admin.paket.pemesanan.pembayaran.create', [
            'title' => 'Tambah Pembayaran',
            'page' => 'pembayaran',
            'pemesanan' => $pemesanan,
            'pemesanans' => Pemesanan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'jumlah_pembayaran' => 'required|integer',
            'metode_pembayaran' => 'required|string',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
            'keterangan' => 'nullable|string',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('pembayaran-bukti');
            $validateData['bukti_pembayaran'] = $path;
        }

        Pembayaran::create($validateData);
        return back()->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('admin.paket.pemesanan.pembayaran.show', [
            'title' => 'Detail Pembayaran',
            'page' => 'pembayaran',
            'pembayaran' => $pembayaran,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        return view('admin.paket.pemesanan.pembayaran.edit', [
            'title' => 'Edit Pembayaran',
            'page' => 'pembayaran',
            'pembayaran' => $pembayaran,
            'pemesanans' => Pemesanan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|integer',
            'jumlah_pembayaran' => 'required|integer',
            'metode_pembayaran' => 'required|string',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:3145728',
            'keterangan' => 'nullable|string',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('pembayaran-bukti');
            $validateData['bukti_pembayaran'] = $path;
        } else {
            $validateData['bukti_pembayaran'] = $pembayaran->bukti_pembayaran;
        }

        $pembayaran->update($validateData);
        return back()->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return back()->with('success', 'Pembayaran berhasil dihapus');
    }
}
