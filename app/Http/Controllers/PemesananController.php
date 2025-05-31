<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use App\Models\Pemesanan;
use App\Models\PemesananKamar;
use App\Models\PermintaanKamar;
use App\Models\PemesananEkstra;
use Illuminate\Http\Request;

class PemesananController extends Controller
{

//-- PEMESANAN KAMAR --//

    /**
     * Show the form for creating a new room booking.
     */
    public function createPemesananKamar()
    {
        return view('home.pemesanan.kamar.pemesanan-kamar', [
            'title' => 'Pemesanan Kamar',
            'kamars' => Ekstra::where('jenis_ekstra', 'tipe kamar')->get(),
        ]);
    }

    /**
     * Store a newly created room booking in storage.
     */
    public function storePemesananKamar(Request $request)
    {
        $validateData = $request->validate([
            'tipe_kamar' => 'required|string',
            'jumlah_pengisi' => 'required|integer',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        
        PemesananKamar::create(array_merge($validateData, [
            'pemesanan_id' => 1 // Replace with actual pemesanan_id logic
        ]));
        
        return back()->with('success', 'Pemesanan Kamar berhasil disimpan');
    }

//-- PERMINTAAN KAMAR --//

    /**
     * Display a listing of the resource.
     */
    public function indexPermintaanKamar(PemesananKamar $pemesananKamar)
    {
        return view('home.pemesanan.kamar.permintaan.index', [
            'title' => 'Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'pemesananKamar' => $pemesananKamar,
            'permintaanKamars' => ($pemesananKamar) ? $pemesananKamar->permintaans : PermintaanKamar::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPermintaanKamar(PemesananKamar $pemesananKamar)
    {
        return view('home.pemesanan.kamar.permintaan.add-permintaan', [
            'title' => 'Tambah Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'pemesananKamar' => $pemesananKamar,
            'pemesananKamars' => PemesananKamar::all(),
            'jenisKamar' => Ekstra::where('jenis_ekstra', 'permintaan kamar')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePermintaanKamar(Request $request)
    {
        $validateData = $request->validate([
            'pemesanan_kamar_id' => 'nullable|integer',
            'permintaan_kamar' => 'required|string',
            'harga' => 'required|integer',
            'keterangan' => 'nullable|string',
        ], [
            'permintaan_kamar.required' => 'Permintaan kamar harus dipilih',
            'harga.required' => 'Harga harus diisi',
            'harga.integer' => 'Harga harus berupa angka',
        ]);

        // Jika ada permintaan khusus, gunakan permintaan khusus
        if ($request->permintaan_khusus) {
            $validateData['permintaan'] = $request->permintaan_khusus;
        } else {
            $validateData['permintaan'] = $request->permintaan_kamar;
        }

        // Remove permintaan_kamar from validateData since we're using 'permintaan'
        unset($validateData['permintaan_kamar']);

        PermintaanKamar::create($validateData);
        
        return redirect()->route('permintaan-kamar.index')->with('success', 'Permintaan Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function showPermintaanKamar(PermintaanKamar $permintaanKamar)
    {
        return view('home.pemesanan.kamar.permintaan.show', [
            'title' => 'Detail Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'permintaanKamar' => $permintaanKamar,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPermintaanKamar(PermintaanKamar $permintaanKamar)
    {
        return view('home.pemesanan.kamar.permintaan.edit', [
            'title' => 'Edit Permintaan Kamar',
            'page' => 'permintaan-kamar',
            'permintaanKamar' => $permintaanKamar,
            'pemesananKamars' => PemesananKamar::all(),
            'jenisKamar' => Ekstra::where('jenis_ekstra', 'permintaan kamar')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePermintaanKamar(Request $request, PermintaanKamar $permintaanKamar)
    {
        $validateData = $request->validate([
            'pemesanan_kamar_id' => 'nullable|integer',
            'permintaan_kamar' => 'required|string',
            'harga' => 'required|integer',
            'keterangan' => 'nullable|string',
        ], [
            'permintaan_kamar.required' => 'Permintaan kamar harus dipilih',
            'harga.required' => 'Harga harus diisi',
            'harga.integer' => 'Harga harus berupa angka',
        ]);

        // Jika ada permintaan khusus, gunakan permintaan khusus
        if ($request->permintaan_khusus) {
            $validateData['permintaan'] = $request->permintaan_khusus;
        } else {
            $validateData['permintaan'] = $request->permintaan_kamar;
        }

        // Remove permintaan_kamar from validateData since we're using 'permintaan'
        unset($validateData['permintaan_kamar']);

        $permintaanKamar->update($validateData);
        
        return redirect()->route('permintaan-kamar.index')->with('success', 'Permintaan Kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPermintaanKamar(PermintaanKamar $permintaanKamar)
    {
        $permintaanKamar->delete();
        return back()->with('success', 'Permintaan Kamar berhasil dihapus');
    }

    /**
     * Get harga from ekstra by ID (for AJAX request)
     */
    public function getHargaEkstra($id)
    {
        try {
            $ekstra = Ekstra::findOrFail($id);
            return response()->json([
                'success' => true,
                'harga' => $ekstra->harga,
                'nama_ekstra' => $ekstra->nama_ekstra,
                'deskripsi' => $ekstra->deskripsi ?? ''
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


//-- PEMESANAN EKSTRA --//

    public function createPemesananEkstra()
    {
        $ekstras = Ekstra::whereIn('jenis_ekstra', ['perlengkapan', 'jasa', 'pesawat'])->get();

        return view('home.pemesanan.ekstra.add-ekstra', [
            'title' => 'Tambah Pemesanan Ekstra',
            'ekstras' => $ekstras,
        ]);
    }

    public function storePemesananEkstra(Request $request)
    {
        $request->validate([
            'jenis_ekstra' => 'required|exists:ekstra,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $ekstra = Ekstra::findOrFail($request->jenis_ekstra);

        // Gunakan harga_default sesuai dengan yang ada di view
        $totalHarga = $ekstra->harga_default * $request->jumlah;

        PemesananEkstra::create([
            'ekstra' => $ekstra->nama_ekstra,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Pemesanan ekstra berhasil disimpan.');
    }
}