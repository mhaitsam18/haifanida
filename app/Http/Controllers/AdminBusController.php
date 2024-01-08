<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Paket;
use Illuminate\Http\Request;

class AdminBusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paket $paket = null)
    {
        return view('admin.paket.bus.index', [
            'title' => 'Data bus',
            'page' => 'bus',
            'paket' => $paket,
            'buses' => ($paket) ? $paket->buses : Bus::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paket $paket = null)
    {
        return view('admin.paket.bus.create', [
            'title' => 'Tambah Data bus',
            'page' => 'bus',
            'paket' => $paket,
            'pakets' => Paket::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'nomor_rombongan' => 'required|string',
            'nomor_polisi' => 'nullable|string',
            'merek' => 'nullable|string',
            'kapasitas' => 'nullable|string',
            'fasilitas' => 'nullable|string',
        ]);

        Bus::create($validateData);
        return back()->with('success', 'Data Bus berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return view('admin.paket.bus.show', [
            'title' => 'Detail bus',
            'page' => 'bus',
            'bus' => $bus,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bus $bus)
    {
        return view('admin.paket.bus.edit', [
            'title' => 'Edit bus',
            'page' => 'bus',
            'bus' => $bus,
            'pakets' => Paket::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $validateData = $request->validate([
            'paket_id' => 'required|integer',
            'nomor_rombongan' => 'required|string',
            'nomor_polisi' => 'nullable|string',
            'merek' => 'nullable|string',
            'kapasitas' => 'nullable|string',
            'fasilitas' => 'nullable|string',
        ]);

        $bus->update($validateData);
        return back()->with('success', 'Data Bus berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return back()->with('success', 'Data Bus berhasil dihapus');
    }
}
