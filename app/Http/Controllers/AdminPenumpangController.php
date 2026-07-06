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
        $penumpangs = ($bus) ? $bus->penumpang()->paginate(200) : BusJemaah::paginate(200);

        $pesertaJemaahs = $bus
            ? Jemaah::whereHas('pemesanan', function ($query) use ($bus) {
                $query->where('paket_id', $bus->paket_id);
            })->get()
            : collect();
        $assignedJemaahIds = $bus ? $bus->penumpang()->pluck('jemaah_id') : collect();

        return view('admin.paket.bus.penumpang.index', [
            'title' => 'Data penumpang',
            'page' => 'penumpang',
            'bus' => $bus,
            'penumpangs' => $penumpangs,
            'createJemaahs' => $pesertaJemaahs->whereNotIn('id', $assignedJemaahIds),
            'editJemaahsPerPenumpang' => collect($penumpangs->items())->mapWithKeys(function ($penumpang) use ($pesertaJemaahs, $assignedJemaahIds) {
                return [
                    $penumpang->id => $pesertaJemaahs->filter(function ($jemaah) use ($assignedJemaahIds, $penumpang) {
                        return !$assignedJemaahIds->contains($jemaah->id) || $jemaah->id == $penumpang->jemaah_id;
                    }),
                ];
            }),
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
