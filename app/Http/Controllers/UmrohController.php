<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\Jemaah;
use App\Models\Provinsi;
use App\Models\Ekstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UmrohController extends Controller
{
    // public function index()
    // {
    //     return view('home.umroh', [
    //         'title' => 'Paket Umroh',
    //         'pakets' => Paket::where('jenis_paket', 'umroh')
    //             ->whereNotNull('published_at')
    //             ->latest()
    //             ->get()
    //     ]);
    // }

    // public function show($id)
    // {
    //     $paket = Paket::findOrFail($id);
    //     return view('home.detail-paket', [
    //         'title' => $paket->nama_paket,
    //         'paket' => $paket
    //     ]);
    // }
    // MODIFY

    public function index(Request $request)
    {
        // Base query
        $query = Paket::where('jenis_paket', 'umroh')
            ->whereNotNull('published_at');
        
        // Price range filter
        if ($request->has('harga_min') && $request->harga_min) {
            $query->where('harga', '>=', $request->harga_min);
        }
        
        if ($request->has('harga_max') && $request->harga_max) {
            $query->where('harga', '<=', $request->harga_max);
        }
        
        // Departure date filter
        if ($request->has('tanggal_mulai') && $request->tanggal_mulai) {
            $query->where('tanggal_mulai', '>=', $request->tanggal_mulai);
        }
        
        if ($request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $query->where('tanggal_mulai', '<=', $request->tanggal_akhir);
        }
        
        // Duration filter
        if ($request->has('durasi') && !empty($request->durasi)) {
            $query->whereIn('durasi', $request->durasi);
        }
        
        // Sort options
        if ($request->has('urutkan')) {
            switch ($request->urutkan) {
                case 'harga_terendah':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'harga_tertinggi':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'tanggal_terdekat':
                    $query->orderBy('tanggal_mulai', 'asc');
                    break;
                case 'durasi_terpendek':
                    $query->orderBy('durasi', 'asc');
                    break;
                case 'durasi_terpanjang':
                    $query->orderBy('durasi', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest(); // Default sorting
        }
        
        // Execute query
        $pakets = $query->get();
        
        // Get unique durations for filter options
        $durasiOptions = Paket::where('jenis_paket', 'umroh')
            ->whereNotNull('published_at')
            ->distinct()
            ->pluck('durasi')
            ->sort()
            ->toArray();
            
        // Price range for filter options
        $hargaMin = Paket::where('jenis_paket', 'umroh')
            ->whereNotNull('published_at')
            ->min('harga');
            
        $hargaMax = Paket::where('jenis_paket', 'umroh')
            ->whereNotNull('published_at')
            ->max('harga');
            
        // Get earliest and latest departure dates
        $tanggalMin = Paket::where('jenis_paket', 'umroh')
            ->whereNotNull('published_at')
            ->min('tanggal_mulai');
            
        $tanggalMax = Paket::where('jenis_paket', 'umroh')
            ->whereNotNull('published_at')
            ->max('tanggal_mulai');
            
        return view('home.umroh', [
            'title' => 'Paket Umroh',
            'pakets' => $pakets,
            'durasiOptions' => $durasiOptions,
            'hargaMin' => $hargaMin,
            'hargaMax' => $hargaMax,
            'tanggalMin' => $tanggalMin ? Carbon::parse($tanggalMin)->format('Y-m-d') : null,
            'tanggalMax' => $tanggalMax ? Carbon::parse($tanggalMax)->format('Y-m-d') : null,
            'filters' => $request->all()
        ]);
    }

    public function show($id)
    {
        $paket = Paket::findOrFail($id);
        return view('home.detail-paket', [
            'title' => $paket->nama_paket,
            'paket' => $paket
        ]);
    }

    public function formPemesanan(Request $request)
    {   
        $user = Auth::user();
        $paket = Paket::findOrFail($request->paket_id);

        return view('home.pemesanan.pemesanan-umroh', [
            'title' => 'Form Pemesanan Umroh',
            'paket' => $paket,
            'user' => $user
        ]);
    }

    public function storePemesanan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'paket_id' => 'required|integer',
            'user_id' => 'required|integer',
            // 'is_umroh' => 'nullable|integer',
            // 'is_haji' => 'nullable|integer',
            // 'is_wisata_halal' => 'nullable|integer',
            'status' => 'nullable|string',
            'tanggal_pesan' => 'nullable|date',
            // 'tanggal_berangkat' => 'nullable|date',
            'jumlah_orang' => 'nullable|integer',
            'total_harga' => 'nullable|integer',
            'metode_pembayaran' => 'nullable|string',
            'is_pembayaran_lunas' => 'nullable|integer',
            'tanggal_pelunasan' => 'nullable|date',
            // 'check_at_least_one' => 'required_without_all:is_umroh,is_haji,is_wisata_halal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data paket
        $paket = Paket::findOrFail($request->paket_id);
        // Simpan pemesanan
        $pemesanan = new Pemesanan();
        $pemesanan->paket_id = $request->paket_id;
        $pemesanan->user_id = $request->user_id;
        $pemesanan->status = "pending";
        $pemesanan->tanggal_pesan = $request->tanggal_pesan;
        $pemesanan->jumlah_orang = $request->jumlah_orang;
        $pemesanan->total_harga = $paket->harga * $pemesanan->jumlah_orang; // Contoh perhitungan
        $pemesanan->metode_pembayaran = $request->metode_pembayaran;
        $pemesanan->is_pembayaran_lunas = 0;
        $pemesanan->tanggal_pelunasan = $request->tanggal_pelunasan;
        $pemesanan->save();
        // Redirect ke halaman detail pemesanan
        return redirect()->route('pemesanan.detail', $pemesanan->id)->with('success', 'Pemesanan berhasil disimpan!');
    }

    public function detailPemesanan($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        // where('id', $id)
        // ->where('user_id', auth()->id()) //agar hanya milik dia saja yang bisa dia lihat
        // ->firstOrFail();
        return view('home.pemesanan.detail-pemesanan', [
            'title' => 'Detail Pemesanan',
            'pemesanan' => $pemesanan
        ]);
    }

    public function listJemaah($id)
    {   
        $jemaahs = Jemaah::where('pemesanan_id', $id)->get();
        $pemesanan = Pemesanan::findOrFail($id);
        // BYPASS DEV
        // where('id', $id)
        // ->where('user_id', auth()->id()) //agar hanya milik dia saja yang bisa dia lihat
        // ->firstOrFail();
        return view('home.pemesanan.jemaah', [
            'title' => 'Detail Pemesanan',
            'pemesanan' => $pemesanan,
            'jemaahs' => $jemaahs
        ]);
    }
    public function createJemaah($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        // BYPASS DEV
        // where('id', $id)
        // ->where('user_id', auth()->id()) //agar hanya milik dia saja yang bisa dia lihat
        // ->firstOrFail();
        return view('home.pemesanan.add-jemaah', [
            'title' => 'Tambah Jemaah',
            'pemesanan' => $pemesanan
        ]);
    }

    public function storeJemaah(Request $request, $id)
    {
        $validateData = $request->validate([
            'pemesanan_id' => 'required|string',
            'grup_id' => 'nullable|string',
            'mahram_id' => 'nullable|string',
            'nomor_ktp' => 'nullable|string',
            'nama_lengkap' => 'nullable|string',
            'nama_sesuai_paspor' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'kewarganegaraan' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'nomor_telepon' => 'nullable|string',
            'email' => 'nullable|string',
            'tingkat_pendidikan' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'nomor_paspor' => 'nullable|string',
            'tempat_dikeluarkan' => 'nullable|string',
            'tanggal_dikeluarkan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'pernah_umroh' => 'nullable|boolean',
            'pernah_haji' => 'nullable|boolean',
            'hubungan_mahram' => 'nullable|string',
            'golongan_darah' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'nama_keluarga_terdekat' => 'nullable|string',
            'kontak_keluarga_terdekat' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            // Simpan foto
            if ($request->hasFile('foto')) {
                $validateData['foto'] = $request->file('foto')->store('jemaah-foto');
            }

            // Tambahkan data wajib
            $validateData['pemesanan_id'] = $id;
            // $validateData['is_active'] = true;

            Jemaah::create($validateData);

            return redirect()->route('pemesanan.jemaah.list', $id)
                ->with('success', 'Data jemaah berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menambahkan jemaah: '.$e->getMessage());
        }
    }


//     public function store(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//     'paket_id' => 'required|exists:pakets,id',
//     'jamaah' => 'required|array',
//     'jamaah.*.nama_lengkap' => 'required|string|max:255',
//     'jamaah.*.email' => 'required|email|max:255',
//     'jamaah.*.nomor_telepon' => 'required|string|max:20',
//     'jamaah.*.nomor_ktp' => 'required|string|max:20',
//     'jamaah.*.tempat_lahir' => 'required|string|max:100',
//     'jamaah.*.tanggal_lahir' => 'required|date',
//     'jamaah.*.jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
//     'jamaah.*.golongan_darah' => 'required|in:A,B,AB,O',
//     'jamaah.*.kewarganegaraan' => 'required|in:WNI,WNA',
//     'jamaah.*.provinsi' => 'required|string|max:100', // Validasi nama provinsi
//     'jamaah.*.kabupaten' => 'required|string|max:100',
//     'jamaah.*.kecamatan' => 'required|string|max:100',
//     'jamaah.*.kelurahan' => 'required|string|max:100',
//     'jamaah.*.kode_pos' => 'required|string|max:10',
//     'jamaah.*.tingkat_pendidikan' => 'required|in:SD,SLTP,SLTA,D1/D2/D3,D4/S1,S2,S3',
//     'jamaah.*.alamat' => 'required|string',
//     'jamaah.*.pekerjaan' => 'required|string|max:100',
//     'jamaah.*.foto' => 'nullable|image|mimes:jpeg,png|max:2048',
//     'jamaah.*.nama_sesuai_paspor' => 'required|string|max:255',
//     'jamaah.*.nomor_paspor' => 'required|string|max:20',
//     'jamaah.*.tempat_dikeluarkan' => 'required|string|max:100',
//     'jamaah.*.tanggal_dikeluarkan' => 'required|date',
//     'jamaah.*.tanggal_kadaluarsa' => 'required|date',
//     'jamaah.*.nama_keluarga_terdekat' => 'required|string|max:255',
//     'jamaah.*.kontak_keluarga_terdekat' => 'required|string|max:20',
//     'jamaah.*.pilihan_kamar' => 'required|in:Double,Triple,Quad',
//     'jamaah.*.ekstra' => 'nullable|array',
//     'catatan' => 'nullable|string',
// ]);

// if ($validator->fails()) {
//     return redirect()->back()->withErrors($validator)->withInput();
// }

// $validated = $validator->validated();

// $pemesanan = \App\Models\Pemesanan::create([
//     'paket_id' => $validated['paket_id'],
//     'user_id' => auth()->id(),
//     'jumlah_orang' => count($validated['jamaah']),
//     'total_harga' => $this->calculateTotalHarga($validated['jamaah'], $validated['paket_id']),
//     'status' => 'Tertunda',
//     'tanggal_pesan' => now(),
//     'metode_pembayaran' => 'Bank Transfer',
// ]);

// foreach ($validated['jamaah'] as $index => $jamaahData) {
//     $jamaah = \App\Models\Jemaah::create([
//         'pemesanan_id' => $pemesanan->id,
//         'nama_lengkap' => $jamaahData['nama_lengkap'],
//         'email' => $jamaahData['email'],
//         'nomor_telepon' => $jamaahData['nomor_telepon'],
//         'nomor_ktp' => $jamaahData['nomor_ktp'],
//         'tempat_lahir' => $jamaahData['tempat_lahir'],
//         'tanggal_lahir' => $jamaahData['tanggal_lahir'],
//         'jenis_kelamin' => $jamaahData['jenis_kelamin'],
//         'golongan_darah' => $jamaahData['golongan_darah'],
//         'kewarganegaraan' => $jamaahData['kewarganegaraan'],
//         'provinsi' => $jamaahData['provinsi'], // Simpan nama provinsi langsung
//         'kabupaten' => $jamaahData['kabupaten'],
//         'kecamatan' => $jamaahData['kecamatan'],
//         'kelurahan' => $jamaahData['kelurahan'],
//         'kode_pos' => $jamaahData['kode_pos'],
//         'tingkat_pendidikan' => $jamaahData['tingkat_pendidikan'],
//         'alamat' => $jamaahData['alamat'],
//         'pekerjaan' => $jamaahData['pekerjaan'],
//         'nama_sesuai_paspor' => $jamaahData['nama_sesuai_paspor'],
//         'nomor_paspor' => $jamaahData['nomor_paspor'],
//         'tempat_dikeluarkan' => $jamaahData['tempat_dikeluarkan'],
//         'tanggal_dikeluarkan' => $jamaahData['tanggal_dikeluarkan'],
//         'tanggal_kadaluarsa' => $jamaahData['tanggal_kadaluarsa'],
//         'nama_keluarga_terdekat' => $jamaahData['nama_keluarga_terdekat'],
//         'kontak_keluarga_terdekat' => $jamaahData['kontak_keluarga_terdekat'],
//         'pilihan_kamar' => $jamaahData['pilihan_kamar'],
//         'foto' => isset($request->file('jamaah')[$index]['foto']) ? $request->file('jamaah')[$index]['foto']->store('jamaah_fotos', 'public') : null,
//     ]);

//     if (isset($jamaahData['ekstra'])) {
//         foreach ($jamaahData['ekstra'] as $ekstra) {
//             \App\Models\PemesananEkstra::create([
//                 'pemesanan_id' => $pemesanan->id,
//                 'jamaah_id' => $jamaah->id,
//                 'ekstra' => $ekstra,
//                 'jumlah' => 1,
//                 'total_harga' => Ekstra::where('nama_ekstra', $ekstra)->first()->harga_default,
//             ]);
//         }
//     }
// }

// return redirect()->route('pemesanan.payment', $pemesanan->id)->with('success', 'Pemesanan berhasil, silakan lanjutkan ke pembayaran.');
//     }

//     private function calculateTotalHarga($jamaahData, $paketId)
//     {
//         $paket = Paket::findOrFail($paketId);
//         $total = $paket->harga * count($jamaahData);
//         foreach ($jamaahData as $jamaah) {
//             if (isset($jamaah['ekstra'])) {
//                 foreach ($jamaah['ekstra'] as $ekstra) {
//                     $total += Ekstra::where('nama_ekstra', $ekstra)->first()->harga_default;
//                 }
//             }
//         }
//         return $total;
//     }
    
}