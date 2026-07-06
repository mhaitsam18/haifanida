<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Jemaah;
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
            'buses' => ($paket) ? $paket->buses()->paginate(200) : Bus::paginate(200),
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
            'kapasitas' => 'nullable|integer|min:1',
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
        $pesertaJemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($bus) {
            $query->where('paket_id', $bus->paket_id);
        })->get();
        $assignedJemaahIds = $bus->penumpang()->pluck('jemaah_id');

        return view('admin.paket.bus.show', [
            'title' => 'Detail bus',
            'page' => 'bus',
            'bus' => $bus,
            'createJemaahs' => $pesertaJemaahs->whereNotIn('id', $assignedJemaahIds),
            'editJemaahsPerPenumpang' => $bus->penumpang->mapWithKeys(function ($penumpang) use ($pesertaJemaahs, $assignedJemaahIds) {
                return [
                    $penumpang->id => $pesertaJemaahs->filter(function ($jemaah) use ($assignedJemaahIds, $penumpang) {
                        return !$assignedJemaahIds->contains($jemaah->id) || $jemaah->id == $penumpang->jemaah_id;
                    }),
                ];
            }),
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
            'kapasitas' => 'nullable|integer|min:1',
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
