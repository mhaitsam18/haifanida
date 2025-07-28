<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Paket;
use App\Models\PaketHotel;
use Illuminate\Http\Request;

class AdminPenginapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paket $paket = null)
    {
        return view('admin.paket.penginapan.index', [
            'title' => 'Data Hotel / Penginapan',
            'page' => 'penginapan',
            'paket' => $paket,
            'penginapans' => ($paket) ? $paket->penginapans : PaketHotel::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paket $paket = null)
    {
        return view('admin.paket.penginapan.create', [
            'title' => 'Tambah Data Hotel / penginapan',
            'page' => 'penginapan',
            'paket' => $paket,
            'pakets' => Paket::all(),
            'hotels' => Hotel::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'hotel_id' => 'required|integer',
            'nomor_reservasi' => 'nullable|string',
            'tanggal_check_in' => 'nullable|date',
            'tanggal_check_out' => 'nullable|date',
            'jumlah_kamar' => 'nullable|numeric',
            'total_harga' => 'nullable|numeric',
            'keterangan_hotel' => 'nullable|string',
        ]);

        PaketHotel::create($validateData);
        return back()->with('success', 'Data Penginapan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaketHotel $paketHotel)
    {
        return view('admin.paket.penginapan.show', [
            'title' => 'Detail Hotel / Penginapan',
            'page' => 'penginapan',
            'penginapan' => $paketHotel,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaketHotel $paketHotel)
    {
        return view('admin.paket.penginapan.edit', [
            'title' => 'Edit Hotel / Penginapan',
            'page' => 'penginapan',
            'penginapan' => $paketHotel,
            'pakets' => Paket::all(),
            'hotels' => Hotel::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaketHotel $paketHotel)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'hotel_id' => 'nullable|integer',
            'nomor_reservasi' => 'nullable|string',
            'tanggal_check_in' => 'nullable|date',
            'tanggal_check_out' => 'nullable|date',
            'jumlah_kamar' => 'nullable|numeric',
            'total_harga' => 'nullable|numeric',
            'keterangan_hotel' => 'nullable|string',
        ]);

        $paketHotel->update($validateData);
        return back()->with('success', 'Data Penginapan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaketHotel $paketHotel)
    {
        $paketHotel->delete();
        return back()->with('success', 'Data Penginapan berhasil dihapus');
    }
}
