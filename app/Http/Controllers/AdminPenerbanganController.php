<?php

namespace App\Http\Controllers;

use App\Models\Maskapai;
use App\Models\Paket;
use App\Models\PaketMaskapai;
use Illuminate\Http\Request;

class AdminPenerbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paket $paket = null)
    {
        return view('admin.paket.penerbangan.index', [
            'title' => 'Data Maskapai / penerbangan',
            'page' => 'penerbangan',
            'paket' => $paket,
            'penerbangans' => ($paket) ? $paket->penerbangans : PaketMaskapai::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paket $paket = null)
    {
        return view('admin.paket.penerbangan.create', [
            'title' => 'Tambah Data Maskapai / penerbangan',
            'page' => 'penerbangan',
            'paket' => $paket,
            'pakets' => Paket::all(),
            'maskapais' => Maskapai::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'maskapai_id' => 'required|integer',
            'nomor_penerbangan' => 'nullable|string',
            'nomor_pnr' => 'nullable|string',
            'kelas' => 'nullable|string',
            'kuota' => 'nullable|numeric',
            'keterangan_penerbangan' => 'nullable|string',
            'total_harga' => 'nullable|numeric',
            'bandara_asal' => 'nullable|string',
            'bandara_tujuan' => 'nullable|string',
            'waktu_keberangkatan' => 'nullable|string',
            'waktu_kedatangan' => 'nullable|string',
            'status_penerbangan' => 'nullable|string',
            'tipe_penerbangan' => 'nullable|string',
            'gate_penerbangan' => 'nullable|string',
        ]);

        PaketMaskapai::create($validateData);
        return back()->with('success', 'Data Penerbangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaketMaskapai $paketMaskapai)
    {
        return view('admin.paket.penerbangan.show', [
            'title' => 'Detail Maskapai / penerbangan',
            'page' => 'penerbangan',
            'penerbangan' => $paketMaskapai,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaketMaskapai $paketMaskapai)
    {
        return view('admin.paket.penerbangan.edit', [
            'title' => 'Edit Maskapai / penerbangan',
            'page' => 'penerbangan',
            'penerbangan' => $paketMaskapai,
            'pakets' => Paket::all(),
            'maskapais' => Maskapai::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaketMaskapai $paketMaskapai)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'maskapai_id' => 'required|integer',
            'nomor_penerbangan' => 'nullable|string',
            'nomor_pnr' => 'nullable|string',
            'kelas' => 'nullable|string',
            'kuota' => 'nullable|numeric',
            'keterangan_penerbangan' => 'nullable|string',
            'total_harga' => 'nullable|numeric',
            'bandara_asal' => 'nullable|string',
            'bandara_tujuan' => 'nullable|string',
            'waktu_keberangkatan' => 'nullable|string',
            'waktu_kedatangan' => 'nullable|string',
            'status_penerbangan' => 'nullable|string',
            'tipe_penerbangan' => 'nullable|string',
            'gate_penerbangan' => 'nullable|string',
        ]);

        $paketMaskapai->update($validateData);
        return back()->with('success', 'Data Penerbangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaketMaskapai $paketMaskapai)
    {
        $paketMaskapai->delete();
        return back()->with('success', 'Data Penerbangan berhasil dihapus');
    }
}
