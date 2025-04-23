<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusJemaah;
use App\Models\Jemaah;
use Illuminate\Http\Request;

class AdminBusJemaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Jemaah $jemaah = null)
    {
        return view('admin.paket.jemaah.bus.index', [
            'title' => 'Data Penumpang',
            'page' => 'bus-jemaah',
            'busJemaahs' => $jemaah ? BusJemaah::where('jemaah_id', $jemaah->id)->get() : BusJemaah::all(),
            'jemaah' => $jemaah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Jemaah $jemaah = null, Bus $bus = null)
    {
        $paket_id = $jemaah->pemesanan->paket_id;
        $jemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();
        $buses = Bus::where('paket_id', $paket_id)->get();
        return view('admin.paket.jemaah.bus.create', [
            'title' => 'Tambah Data penumpang',
            'page' => 'bus-jemaah',
            'buses' => $buses,
            'jemaahs' => $jemaahs,
            'bus' => $bus,
            'jemaah' => $jemaah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'bus_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
            'nomor_kursi' => 'required|string',
        ]);

        BusJemaah::create($validateData);
        return back()->with('success', 'Data Penumpang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BusJemaah $busJemaah)
    {
        return view('admin.paket.jemaah.bus.show', [
            'title' => 'Detail Penumpang',
            'page' => 'bus-jemaah',
            'bus' => $busJemaah,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusJemaah $busJemaah)
    {

        $paket_id = $busJemaah->bus->paket_id;

        $buses = Bus::where('paket_id', $paket_id)->get();

        $jemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();

        return view('admin.paket.jemaah.bus.edit', [
            'title' => 'Edit Data Penumpang',
            'page' => 'bus-jemaah',
            'busJemaah' => $busJemaah,
            'buses' => $buses,
            'jemaahs' => $jemaahs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusJemaah $busJemaah)
    {
        $validateData = $request->validate([
            'bus_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
            'nomor_kursi' => 'required|string',
        ]);

        $busJemaah->update($validateData);
        return back()->with('success', 'Data Penumpang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusJemaah $busJemaah)
    {
        $busJemaah->delete();
        return back()->with('success', 'Data Penumpang berhasil dihapus');
    }
}
