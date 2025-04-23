<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusJemaah;
use App\Models\Jemaah;
use Illuminate\Http\Request;

class AdminPenumpangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Bus $bus = null)
    {
        return view('admin.paket.bus.penumpang.index', [
            'title' => 'Data penumpang',
            'page' => 'penumpang',
            'bus' => $bus,
            'penumpangs' => ($bus) ? $bus->penumpang : BusJemaah::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Bus $bus = null)
    {
        $jemaahs = Jemaah::whereDoesntHave('busJemaahs', function ($query) use ($bus) {
            $query->where('bus_id', $bus->id);
        })->whereHas('pemesanan', function ($query) use ($bus) {
            $query->where('paket_id', $bus->paket_id);
        })->get();

        return view('admin.paket.bus.penumpang.create', [
            'title' => 'Tambah Data Penumpang',
            'page' => 'penumpang',
            'bus' => $bus,
            'buses' => Bus::all(),
            'jemaahs' => $jemaahs,
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
        return view('admin.paket.bus.penumpang.show', [
            'title' => 'Detail Penumpang',
            'page' => 'bus',
            'bus' => $busJemaah,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusJemaah $busJemaah)
    {
        $bus = $busJemaah->bus;

        $jemaahs = Jemaah::whereDoesntHave('busJemaahs', function ($query) use ($busJemaah) {
            $query->where('bus_id', $busJemaah->bus_id);
            $query->where('jemaah_id', '!=', $busJemaah->jemaah_id);
        })->whereHas('pemesanan', function ($query) use ($bus) {
            $query->where('paket_id', $bus->paket_id);
        })->get();

        return view('admin.paket.bus.penumpang.edit', [
            'title' => 'Edit penumpang',
            'page' => 'penumpang',
            'penumpang' => $busJemaah,
            'buses' => Bus::all(),
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
