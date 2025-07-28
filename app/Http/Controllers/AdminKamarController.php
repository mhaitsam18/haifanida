<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\PaketHotel;
use Illuminate\Http\Request;

class AdminKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaketHotel $paketHotel = null)
    {
        return view('admin.paket.penginapan.kamar.index', [
            'title' => 'Data Kamar',
            'page' => 'kamar',
            'paketHotel' => $paketHotel,
            'penginapan' => $paketHotel,
            'kamars' => ($paketHotel) ? $paketHotel->kamars : Kamar::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PaketHotel $paketHotel = null)
    {
        return view('admin.paket.penginapan.kamar.create', [
            'title' => 'Tambah Kamar',
            'page' => 'kamar',
            'paketHotel' => $paketHotel,
            'penginapan' => $paketHotel,
            'paketHotels' => PaketHotel::all(),
            'penginapans' => PaketHotel::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_hotel_id' => 'required|integer',
            'nomor_kamar' => 'nullable|string',
            'tipe_kamar' => 'nullable|string',
            'kapasitas' => 'nullable|numeric',
            'fasilitas' => 'nullable|string',
            'tersedia' => 'nullable|numeric',
        ]);

        Kamar::create($validateData);
        return back()->with('success', 'Data Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        return view('admin.paket.penginapan.kamar.show', [
            'title' => 'Detail Kamar',
            'page' => 'kamar',
            'kamar' => $kamar,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        return view('admin.paket.penginapan.kamar.edit', [
            'title' => 'Edit Kamar',
            'page' => 'kamar',
            'kamar' => $kamar,
            'paketHotels' => PaketHotel::all(),
            'penginapans' => PaketHotel::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $validateData = $request->validate([
            'paket_hotel_id' => 'required|integer',
            'nomor_kamar' => 'nullable|string',
            'tipe_kamar' => 'nullable|string',
            'kapasitas' => 'nullable|numeric',
            'fasilitas' => 'nullable|string',
            'tersedia' => 'nullable|numeric',
        ]);

        $kamar->update($validateData);
        return back()->with('success', 'Data Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return back()->with('success', 'Data Kamar berhasil dihapus');
    }
}
