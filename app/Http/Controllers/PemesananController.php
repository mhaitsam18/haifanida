<?php

namespace App\Http\Controllers;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\Ekstra;
use App\Models\Pemesanan;
use App\Models\PemesananKamar;
use App\Models\PermintaanKamar;
use App\Models\PemesananEkstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{

//-- PEMESAN --// 

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'jumlah_jemaah' => 'required|integer|min:1',
        ]);

        if ($request->has('is_jemaah')) {
            Jemaah::create([
                'user_id' => auth()->id(),
                'nama_lengkap' => $request->nama,
                'email' => $request->email,
                'nomor_telepon' => $request->telepon,
                'foto' => null, // atau default value jika perlu
            ]);
        }

        // Redirect ke halaman daftar jemaah
        return redirect()->route('pemesanan.detail', [
            'pemesanan' => $request->input('pemesanan_id')
        ])->with('success', 'Data pemesan berhasil disimpan.');
    }

//-- PEMESANAN --//

    // public function storePemesanan(Request $request)
    // {
    //     // Validasi input
    //     $validator = Validator::make($request->all(), [
    //         'paket_id' => 'required|integer',
    //         'user_id' => 'required|integer',
    //         // 'is_umroh' => 'nullable|integer',
    //         // 'is_haji' => 'nullable|integer',
    //         // 'is_wisata_halal' => 'nullable|integer',
    //         'status' => 'nullable|string',
    //         'tanggal_pesan' => 'nullable|date',
    //         // 'tanggal_berangkat' => 'nullable|date',
    //         'jumlah_orang' => 'required|integer',
    //         'total_harga' => 'nullable|integer',
    //         'metode_pembayaran' => 'nullable|string',
    //         'is_pembayaran_lunas' => 'nullable|integer',
    //         'tanggal_pelunasan' => 'nullable|date',
    //         // 'check_at_least_one' => 'required_without_all:is_umroh,is_haji,is_wisata_halal',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Ambil data paket
    //     $paket = Paket::findOrFail($request->paket_id);
    //     // Simpan pemesanan
    //     $pemesanan = new Pemesanan();
    //     $pemesanan->paket_id = $request->paket_id;
    //     $pemesanan->user_id = $request->user_id;
    //     $pemesanan->status = "pending";
    //     $pemesanan->tanggal_pesan = $request->tanggal_pesan;
    //     $pemesanan->jumlah_orang = $request->jumlah_orang;
    //     $pemesanan->total_harga = $paket->harga * $pemesanan->jumlah_orang; // Contoh perhitungan
    //     $pemesanan->metode_pembayaran = $request->metode_pembayaran;
    //     $pemesanan->is_pembayaran_lunas = 0;
    //     $pemesanan->tanggal_pelunasan = $request->tanggal_pelunasan;
    //     $pemesanan->save();
    //     // Redirect ke halaman detail pemesanan
    //     return redirect()->route('pemesanan.detail', $pemesanan->id)->with('success', 'Pemesanan berhasil disimpan!');
    // }
    public function storePemesanan(Request $request)
    {
        // Validasi data umum pemesanan
        $validatedData = $request->validate([
            'paket_id' => 'required|integer|exists:paket,id',
            'user_id' => 'required|integer',
            'tanggal_pesan' => 'required|date',
            'jumlah_orang' => 'required|integer|min:1',
            'metode_pembayaran' => 'nullable|string',
            'tanggal_pelunasan' => 'nullable|date',
        ]);

        // Ambil data paket untuk perhitungan total, misalnya
        $paket = Paket::findOrFail($validatedData['paket_id']);

        // Simpan data pemesanan
        $pemesanan = new Pemesanan();
        $pemesanan->paket_id = $validatedData['paket_id'];
        $pemesanan->user_id = $validatedData['user_id'];
        $pemesanan->status = "pending";
        $pemesanan->tanggal_pesan = $validatedData['tanggal_pesan'];
        $pemesanan->jumlah_orang = $validatedData['jumlah_orang'];
        $pemesanan->total_harga = $paket->harga * $validatedData['jumlah_orang']; 
        $pemesanan->metode_pembayaran = $validatedData['metode_pembayaran'] ?? null;
        $pemesanan->is_pembayaran_lunas = 0;
        $pemesanan->tanggal_pelunasan = $validatedData['tanggal_pelunasan'] ?? null;
        $pemesanan->save();

        // PROSES PEMESANAN KAMAR (data dinamis dari "kamars" array)
        if ($request->has('kamars') && is_array($request->kamars)) {
            foreach ($request->kamars as $kamarData) {
                // Validasi tiap data kamar
                $validatedKamar = validator($kamarData, [
                    'tipe_kamar' => 'required|string',
                    'jumlah_pengisi' => 'required|integer|min:1',
                ])->validate();
                
                // Misal, kita ambil harga kamar dari tabel Ekstra dengan tipe kamar
                $ekstraKamar = Ekstra::where('jenis_ekstra', 'tipe kamar')
                            ->where('nama_ekstra', $validatedKamar['tipe_kamar'])
                            ->first();
                $hargaKamar = $ekstraKamar ? $ekstraKamar->harga_default : 0;

                PemesananKamar::create([
                    'pemesanan_id' => $pemesanan->id,
                    'tipe_kamar' => $validatedKamar['tipe_kamar'],
                    'jumlah_pengisi' => $validatedKamar['jumlah_pengisi'],
                    'harga' => $hargaKamar,
                    // Opsional: masukkan keterangan jika tersedia
                    'keterangan' => $kamarData['keterangan'] ?? null,
                ]);
            }
        }

        // PROSES PEMESANAN EKSTRA (data dinamis dari "ekstras" array)
        if ($request->has('ekstras') && is_array($request->ekstras)) {
            foreach ($request->ekstras as $ekstraData) {
                // Validasi tiap data ekstra
                $validatedEkstra = validator($ekstraData, [
                    'ekstra' => 'required|string',
                    'jumlah' => 'required|integer|min:1',
                ])->validate();

                // Dapatkan data ekstra untuk harga default
                $dataEkstra = Ekstra::where('nama_ekstra', $validatedEkstra['ekstra'])
                                ->first();
                $hargaEkstra = $dataEkstra ? $dataEkstra->harga_default : 0;
                $totalHargaEkstra = $hargaEkstra * $validatedEkstra['jumlah'];

                PemesananEkstra::create([
                    'pemesanan_id' => $pemesanan->id,
                    'ekstra' => $validatedEkstra['ekstra'],
                    'jumlah' => $validatedEkstra['jumlah'],
                    'total_harga' => $totalHargaEkstra,
                    'keterangan' => $ekstraData['keterangan'] ?? null,
                ]);
            }
        }

        return redirect()->route('pemesanan.detail', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil disimpan!');
    }
    
    public function detailPemesanan($id)
    {   
        $user = Auth::user();
        $pemesanan = Pemesanan::
        where('id', $id)
        ->where('user_id', auth()->id()) //agar hanya pemesanan milik dia saja yang bisa dia lihat
        ->firstOrFail();
        return view('home.pemesanan.detail-pemesanan', [
            'title' => 'Detail Pemesanan',
            'pemesanan' => $pemesanan,
            'user' => $user
        ]);
    }

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

    // public function createPemesananEkstra()
    // {
    //     $ekstras = Ekstra::whereIn('jenis_ekstra', ['perlengkapan', 'jasa', 'pesawat'])->get();

    //     return view('home.pemesanan.ekstra.add-ekstra', [
    //         'title' => 'Tambah Pemesanan Ekstra',
    //         'ekstras' => $ekstras,
    //     ]);
    // }

    // public function storePemesananEkstra(Request $request)
    // {
    //     $request->validate([
    //         'jenis_ekstra' => 'required|exists:ekstra,id',
    //         'jumlah' => 'required|integer|min:1',
    //     ]);

    //     $ekstra = Ekstra::findOrFail($request->jenis_ekstra);

    //     // Gunakan harga_default sesuai dengan yang ada di view
    //     $totalHarga = $ekstra->harga_default * $request->jumlah;

    //     PemesananEkstra::create([
    //         'ekstra' => $ekstra->nama_ekstra,
    //         'jumlah' => $request->jumlah,
    //         'total_harga' => $totalHarga,
    //         'keterangan' => $request->keterangan,
    //     ]);

    //     return redirect()->back()->with('success', 'Pemesanan ekstra berhasil disimpan.');
    // }

    /**
     * Menampilkan form untuk menambah pemesanan ekstra.
     */
    public function createPemesananEkstra($pemesanan_id = null)
    {
        $ekstras = Ekstra::whereIn('jenis_ekstra', ['perlengkapan', 'jasa', 'pesawat'])->get();
        $pemesanan_id = $pemesanan_id ?? (Auth::check() ? Pemesanan::where('user_id', Auth::id())->latest()->first()->id ?? null : null);

        if (!$pemesanan_id || !Pemesanan::find($pemesanan_id)) {
            return redirect()->route('home')->with('error', 'Pemesanan tidak ditemukan. Silakan buat pemesanan terlebih dahulu.');
        }

        return view('home.pemesanan.ekstra.add-ekstra', [
            'title' => 'Tambah Pemesanan Ekstra',
            'ekstras' => $ekstras,
            'pemesanan_id' => $pemesanan_id,
        ]);
    }

    /**
     * Menyimpan pemesanan ekstra ke database.
     */
    public function storePemesananEkstra(Request $request)
    {
        $validatedData = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'jenis_ekstra' => 'required|exists:ekstra,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'pemesanan_id.required' => 'Pemesanan tidak ditemukan.',
            'pemesanan_id.exists' => 'Pemesanan tidak valid.',
            'jenis_ekstra.required' => 'Jenis ekstra harus dipilih.',
            'jenis_ekstra.exists' => 'Jenis ekstra tidak valid.',
            'jumlah.required' => 'Jumlah harus diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah minimal adalah 1.',
            'total_harga.required' => 'Total harga harus diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
        ]);

        // \Log::info('Fetching Ekstra with ID: ' . $validatedData['jenis_ekstra']);
        $ekstra = Ekstra::findOrFail($validatedData['jenis_ekstra']);

        $expectedTotalHarga = $ekstra->harga_default * $validatedData['jumlah'];
        if (abs($validatedData['total_harga'] - $expectedTotalHarga) > 0.01) {
            return back()->withInput()->withErrors(['total_harga' => 'Total harga tidak sesuai dengan perhitungan.']);
        }

        PemesananEkstra::create([
            'pemesanan_id' => $validatedData['pemesanan_id'],
            'ekstra' => $ekstra->nama_ekstra,
            'jumlah' => $validatedData['jumlah'],
            'total_harga' => $validatedData['total_harga'],
            'keterangan' => $validatedData['keterangan'],
        ]);

            return redirect()->route('pemesanan.detail', $validatedData['pemesanan_id'])
                ->with('success', 'Pemesanan ekstra berhasil disimpan.');
        }

    /**
     * Show the form for editing the specified extra booking.
     */
public function editPemesananEkstra(PemesananEkstra $pemesananEkstra)
{
    $ekstras = Ekstra::whereIn('jenis_ekstra', ['perlengkapan', 'jasa', 'pesawat'])->get();
    $pemesanan_id = $pemesananEkstra->pemesanan_id;

    if (!Pemesanan::find($pemesanan_id)) {
        return redirect()->route('home')->with('error', 'Pemesanan tidak ditemukan.');
    }

    return view('home.pemesanan.ekstra.edit-ekstra', [
        'title' => 'Edit Pemesanan Ekstra',
        'ekstras' => $ekstras,
        'pemesanan_id' => $pemesanan_id,
        'pemesananEkstra' => $pemesananEkstra,
    ]);
}

    /**
     * Update the specified extra booking in storage.
     */
    public function updatePemesananEkstra(Request $request, PemesananEkstra $pemesananEkstra)
    {
        $validatedData = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'jenis_ekstra' => 'required|exists:ekstra,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'pemesanan_id.required' => 'Pemesanan tidak ditemukan.',
            'pemesanan_id.exists' => 'Pemesanan tidak valid.',
            'jenis_ekstra.required' => 'Jenis ekstra harus dipilih.',
            'jenis_ekstra.exists' => 'Jenis ekstra tidak valid.',
            'jumlah.required' => 'Jumlah harus diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah minimal adalah 1.',
            'total_harga.required' => 'Total harga harus diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
        ]);

        $ekstra = Ekstra::findOrFail($validatedData['jenis_ekstra']);

        $expectedTotalHarga = $ekstra->harga_default * $validatedData['jumlah'];
        if (abs($validatedData['total_harga'] - $expectedTotalHarga) > 0.01) {
            return back()->withInput()->withErrors(['total_harga' => 'Total harga tidak sesuai dengan perhitungan.']);
        }

        $pemesananEkstra->update([
            'pemesanan_id' => $validatedData['pemesanan_id'],
            'ekstra' => $ekstra->nama_ekstra,
            'jumlah' => $validatedData['jumlah'],
            'total_harga' => $validatedData['total_harga'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('pemesanan.detail', $validatedData['pemesanan_id'])
            ->with('success', 'Pemesanan ekstra berhasil diperbarui.');
    }

    /**
     * Remove the specified extra booking from storage.
     */
    public function destroyPemesananEkstra(PemesananEkstra $pemesananEkstra)
    {
        $pemesanan_id = $pemesananEkstra->pemesanan_id;
        $pemesananEkstra->delete();

        return redirect()->route('pemesanan.detail', $pemesanan_id)
            ->with('success', 'Pemesanan ekstra berhasil dihapus.');
    }

}