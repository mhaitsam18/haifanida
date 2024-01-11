<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Kamar;
use App\Models\KamarJemaah;
use Illuminate\Http\Request;

class AdminKamarJemaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Kamar $kamar = null, Jemaah $jemaah = null)
    {
        $kamarJemaahs = KamarJemaah::query();
        if ($kamar) {
            $kamarJemaahs->where('kamar_id', $kamar->id);
        }
        if ($jemaah) {
            $kamarJemaahs->where('jemaah_id', $jemaah->id);
        }
        $kamarJemaahs = $kamarJemaahs->get();
        return view('admin.paket.jemaah.kamar.index', [
            'title' => 'Data Tamu',
            'page' => 'kamar-jemaah',
            'kamarJemaahs' => $kamarJemaahs,
            'kamar' => $kamar,
            'jemaah' => $jemaah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Kamar $kamar = null, Jemaah $jemaah = null)
    {
        $kamarJemaahs = KamarJemaah::query();
        $paket_id = null;
        if ($kamar) {
            $kamarJemaahs->where('kamar_id', $kamar->id);
            $paket_id = $kamar->paketHotel->paket_id;
        }
        if ($jemaah) {
            $kamarJemaahs->where('jemaah_id', $jemaah->id);
            $paket_id = $jemaah->pemesanan->paket_id;
        }
        $kamarJemaahs = $kamarJemaahs->get();

        $kamars = Kamar::whereHas('paketHotel', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();
        $jemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();
        return view('admin.paket.jemaah.kamar.create', [
            'title' => 'Tambah Data Penghuni / Tamu',
            'page' => 'kamar-jemaah',
            'kamarJemaahs' => $kamarJemaahs,
            'kamars' => $kamars,
            'jemaahs' => $jemaahs,
            'kamar' => $kamar,
            'jemaah' => $jemaah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kamar_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
        ]);

        KamarJemaah::create($validateData);
        return back()->with('success', 'Data Penghuni berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KamarJemaah $kamarJemaah)
    {
        return view('admin.paket.jemaah.kamar.show', [
            'title' => 'Detail Tamu',
            'page' => 'kamar-jemaah',
            'kamar' => $kamarJemaah,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KamarJemaah $kamarJemaah)
    {
        $paket_id = $kamarJemaah->kamar->paketHotel->paket_id;

        $kamars = Kamar::whereHas('paketHotel', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();
        $jemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();
        return view('admin.paket.jemaah.kamar.edit', [
            'title' => 'Edit Data Penghuni / Tamu',
            'page' => 'kamar-jemaah',
            'kamarJemaah' => $kamarJemaah,
            'kamars' => $kamars,
            'jemaahs' => $jemaahs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KamarJemaah $kamarJemaah)
    {
        $validateData = $request->validate([
            'kamar_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
        ]);

        $kamarJemaah->update($validateData);
        return back()->with('success', 'Data Penghuni berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KamarJemaah $kamarJemaah)
    {
        $kamarJemaah->delete();
        return back()->with('success', 'Data Penghuni berhasil dihapus');
    }
}
