<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
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
            'kamars' => ($paketHotel) ? $paketHotel->kamars()->paginate(200) : Kamar::paginate(200),
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
            'tipe_kamar' => 'nullable|in:Single,Double,Triple,Quad,Suite,Lainnya',
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
        $paket_id = $kamar->paketHotel->paket_id;
        $pesertaJemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();
        $assignedJemaahIds = $kamar->KamarJemaahs()->pluck('jemaah_id');

        return view('admin.paket.penginapan.kamar.show', [
            'title' => 'Detail Kamar',
            'page' => 'kamar',
            'kamar' => $kamar,
            'createJemaahs' => $pesertaJemaahs->whereNotIn('id', $assignedJemaahIds),
            'editJemaahsPerTamu' => $kamar->KamarJemaahs->mapWithKeys(function ($tamu) use ($pesertaJemaahs, $assignedJemaahIds) {
                return [
                    $tamu->id => $pesertaJemaahs->filter(function ($jemaah) use ($assignedJemaahIds, $tamu) {
                        return !$assignedJemaahIds->contains($jemaah->id) || $jemaah->id == $tamu->jemaah_id;
                    }),
                ];
            }),
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
            'tipe_kamar' => 'nullable|in:Single,Double,Triple,Quad,Suite,Lainnya',
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
