<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusJemaah;
use App\Models\Jemaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminBusJemaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Jemaah $jemaah = null)
    {
        $busJemaahs = $jemaah ? BusJemaah::where('jemaah_id', $jemaah->id)->paginate(200) : BusJemaah::paginate(200);
        $busJemaahs->load(['jemaah', 'bus']);

        // Data untuk modal "Tambah" (mengikuti perilaku create() sebelumnya: hanya terisi
        // ketika halaman diakses dalam konteks seorang jemaah).
        $createBuses = collect();
        $createJemaahs = collect();
        if ($jemaah) {
            $paket_id = $jemaah->pemesanan->paket_id;
            $createJemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paket_id) {
                $query->where('paket_id', $paket_id);
            })->get();
            $createBuses = Bus::where('paket_id', $paket_id)->get();
        }

        // Data untuk modal "Edit" per baris (mengikuti perilaku edit() sebelumnya: daftar bus/jemaah
        // di-scope ke paket milik bus baris tsb), dikelompokkan per paket_id supaya tidak N+1 query.
        $paketIds = $busJemaahs->pluck('bus.paket_id')->filter()->unique()->values();
        $editBuses = Bus::whereIn('paket_id', $paketIds)->get()->groupBy(fn ($bus) => (int) $bus->paket_id);
        $editJemaahs = Jemaah::whereHas('pemesanan', function ($query) use ($paketIds) {
            $query->whereIn('paket_id', $paketIds);
        })->with('pemesanan')->get()->groupBy(fn ($item) => (int) $item->pemesanan->paket_id);

        return view('admin.paket.jemaah.bus.index', [
            'title' => 'Data Penumpang',
            'page' => 'bus-jemaah',
            'busJemaahs' => $busJemaahs,
            'jemaah' => $jemaah,
            'createBuses' => $createBuses,
            'createJemaahs' => $createJemaahs,
            'editBuses' => $editBuses,
            'editJemaahs' => $editJemaahs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bus_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
            'nomor_kursi' => [
                'required',
                'string',
                Rule::unique('bus_jemaah', 'nomor_kursi')->where('bus_id', $request->bus_id),
            ],
        ]);

        $validator->after(function ($validator) use ($request) {
            $this->validateKapasitas($validator, $request->bus_id);
        });

        $validateData = $validator->validate();

        BusJemaah::create($validateData);
        return back()->with('success', 'Data Penumpang berhasil ditambahkan');
    }

    /**
     * Tolak jika bus sudah penuh (jumlah penumpang >= kapasitas bus),
     * dikecualikan satu baris BusJemaah yang sedang diedit (bila ada).
     */
    private function validateKapasitas($validator, $busId, $excludeBusJemaahId = null)
    {
        $bus = Bus::find($busId);

        if (! $bus || $bus->kapasitas === null) {
            return;
        }

        $jumlahPenumpang = BusJemaah::where('bus_id', $busId)
            ->when($excludeBusJemaahId, fn ($query) => $query->where('id', '!=', $excludeBusJemaahId))
            ->count();

        if ($jumlahPenumpang >= $bus->kapasitas) {
            $validator->errors()->add('bus_id', "Bus {$bus->nomor_rombongan} sudah penuh ({$jumlahPenumpang}/{$bus->kapasitas}).");
        }
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusJemaah $busJemaah)
    {
        $validator = Validator::make($request->all(), [
            'bus_id' => 'required|integer',
            'jemaah_id' => 'required|integer',
            'nomor_kursi' => [
                'required',
                'string',
                Rule::unique('bus_jemaah', 'nomor_kursi')->where('bus_id', $request->bus_id)->ignore($busJemaah->id),
            ],
        ]);

        $validator->after(function ($validator) use ($request, $busJemaah) {
            $this->validateKapasitas($validator, $request->bus_id, $busJemaah->id);
        });

        $validateData = $validator->validate();

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
