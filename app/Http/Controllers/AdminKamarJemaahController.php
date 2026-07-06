<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Kamar;
use App\Models\KamarJemaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $kamarJemaahs = $kamarJemaahs->paginate(200)->withQueryString();

        $paket_id = null;
        if ($kamar) {
            $paket_id = $kamar->paketHotel->paket_id;
        }
        if ($jemaah) {
            $paket_id = $jemaah->pemesanan->paket_id;
        }
        $kamars = Kamar::whereHas('paketHotel', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();
        $jemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paket_id) {
            $query->where('paket_id', $paket_id);
        })->get();

        return view('admin.paket.jemaah.kamar.index', [
            'title' => 'Data Tamu',
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
        $validator = Validator::make($request->all(), [
            'kamar_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
        ]);

        $validator->after(function ($validator) use ($request) {
            $this->validateKapasitas($validator, $request->kamar_id);
        });

        $validateData = $validator->validate();

        KamarJemaah::create($validateData);
        return back()->with('success', 'Data Penghuni berhasil ditambahkan');
    }

    /**
     * Tolak jika kamar sudah penuh (jumlah penghuni >= kapasitas kamar),
     * dikecualikan satu baris KamarJemaah yang sedang diedit (bila ada).
     */
    private function validateKapasitas($validator, $kamarId, $excludeKamarJemaahId = null)
    {
        $kamar = Kamar::find($kamarId);

        if (! $kamar || $kamar->kapasitas === null) {
            return;
        }

        $jumlahPenghuni = KamarJemaah::where('kamar_id', $kamarId)
            ->when($excludeKamarJemaahId, fn ($query) => $query->where('id', '!=', $excludeKamarJemaahId))
            ->count();

        if ($jumlahPenghuni >= $kamar->kapasitas) {
            $validator->errors()->add('kamar_id', "Kamar {$kamar->nomor_kamar} sudah penuh ({$jumlahPenghuni}/{$kamar->kapasitas}).");
        }
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, KamarJemaah $kamarJemaah)
    {
        $validator = Validator::make($request->all(), [
            'kamar_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
        ]);

        $validator->after(function ($validator) use ($request, $kamarJemaah) {
            $this->validateKapasitas($validator, $request->kamar_id, $kamarJemaah->id);
        });

        $validateData = $validator->validate();

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
