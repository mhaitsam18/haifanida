<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Ekstra;
use App\Models\Jemaah;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }
        
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }
        
        // Departure date filter
        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal_mulai', '>=', $request->tanggal_mulai);
        }
        
        if ($request->filled('tanggal_akhir')) {
            $query->where('tanggal_mulai', '<=', $request->tanggal_akhir);
        }
        
        // Duration filter - Modified
        if ($request->filled('durasi')) {
            $query->where('durasi', $request->durasi);
        }
        
        // Sort options
        if ($request->filled('urutkan')) {
            switch ($request->urutkan) {
                case 'harga_terendah':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'harga_tertinggi':
                    $query->orderBy('harga', 'desc');
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
            $query->latest();
        }
        
        // Execute query
        $pakets = $query->get();
        
        // Get unique durations for filter options
        $durasiOptions = Paket::where('jenis_paket', 'umroh')
            ->whereNotNull('published_at')
            ->distinct()
            ->pluck('durasi')
            ->sort()
            ->values()
            ->toArray();
            
        return view('home.umroh', [
            'title' => 'Paket Umroh',
            'pakets' => $pakets,
            'durasiOptions' => $durasiOptions,
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
    //         'jumlah_orang' => 'nullable|integer',
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

    // public function detailPemesanan($id)
    // {   
    //     $user = Auth::user();
    //     $pemesanan = Pemesanan::
    //     // findOrFail($id);
    //     // BYPASS DEV
    //     where('id', $id)
    //     ->where('user_id', auth()->id()) //agar hanya pemesanan milik dia saja yang bisa dia lihat
    //     ->firstOrFail();
    //     return view('home.pemesanan.detail-pemesanan', [
    //         'title' => 'Detail Pemesanan',
    //         'pemesanan' => $pemesanan,
    //         'user' => $user
    //     ]);
    // }
    
    public function listJemaah($id)
    {   
        $jemaahs = Jemaah::where('pemesanan_id', $id)->get();
        $pemesanan = Pemesanan::
        // findOrFail($id);
        // BYPASS DEV
        where('id', $id)
        ->where('user_id', auth()->id()) //agar hanya pemesanan milik dia saja yang bisa dia lihat
        ->firstOrFail();
        $paket = $pemesanan->paket;

        return view('home.pemesanan.jemaah', [
            'title' => 'Detail Jemaah',
            'pemesanan' => $pemesanan,
            'jemaahs' => $jemaahs,
            'paket' => $paket
        ]);
    }
    public function createJemaah($id)
    {
        $pemesanan = Pemesanan::
        // findOrFail($id);
        // BYPASS DEV
        where('id', $id)
        ->where('user_id', auth()->id()) //agar hanya pemesanan milik dia saja yang bisa dia lihat
        ->firstOrFail();
        return view('home.pemesanan.add-jemaah', [
            'title' => 'Tambah Jemaah',
            'pemesanan' => $pemesanan,
            'provinsis' => Provinsi::all(),
            'kabupatens' => (old('provinsi')) ? Kabupaten::where('provinsi_id', Provinsi::where('provinsi', old('provinsi'))->first()->id)->get() : Kabupaten::all()
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
            // MODIFIED: Handle photo storage properly using public/storage/jemaah-foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Make sure the directory exists
                $path = public_path('storage/jemaah-foto');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                // Move the uploaded file
                $file->move($path, $filename);
                $validateData['foto'] = 'jemaah-foto/' . $filename;
            }

            // Tambahkan data wajib
            $validateData['pemesanan_id'] = $id;

            Jemaah::create($validateData);
            $this->updateJumlahOrangPemesanan($id);
            return redirect()->route('pemesanan.jemaah.list', $id)
                ->with('success', 'Data jemaah berhasil ditambahkan');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menambahkan jemaah: '.$e->getMessage());
        }
    }

    public function destroy(Jemaah $jemaah)
    {   
        $pemesananId = $jemaah->pemesanan_id;
            $fotoPath = $jemaah->foto;

            $jemaah->delete();

            // // Hapus file foto jika ada
            // if ($fotoPath && Storage::exists($fotoPath)) {
            //     Storage::delete($fotoPath);
            // }

            // Panggil fungsi untuk update jumlah orang di pemesanan
            $this->updateJumlahOrangPemesanan($pemesananId);
        return back()->with('success', 'Data jemaah berhasil dihapus');
    }

      protected function updateJumlahOrangPemesanan($pemesananId)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($pemesananId);
            $jumlahJemaahAktual = Jemaah::where('pemesanan_id', $pemesananId)->count();

            $pemesanan->jumlah_orang = $jumlahJemaahAktual;
            // Anda mungkin juga ingin mengkalkulasi ulang total_harga di sini
            // $paket = Paket::find($pemesanan->paket_id);
            // if ($paket) {
            //     $pemesanan->total_harga = $paket->harga * $jumlahJemaahAktual;
            // }
            $pemesanan->save();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle jika pemesanan tidak ditemukan, mungkin log error
            // Log::error("Pemesanan dengan ID: {$pemesananId} tidak ditemukan saat update jumlah orang.");
        } catch (\Exception $e) {
            // Handle error lainnya
            // Log::error("Gagal update jumlah orang untuk pemesanan ID: {$pemesananId}. Error: " . $e->getMessage());
        }
    }
    
    public function editJemaah($pemesananId, $jemaahId)
    {   
        $pemesanan = Pemesanan::findOrFail($pemesananId);
        $jemaah = Jemaah::findOrFail($jemaahId);
        
        // MODIFIED: Load provinsi and kabupaten data for dropdowns
        return view('home.pemesanan.edit-jemaah', [
            'title' => 'Edit Data Jemaah',
            'pemesanan' => $pemesanan,
            'jemaah' => $jemaah,
            'provinsis' => Provinsi::all(),
            'kabupatens' => (old('provinsi', $jemaah->provinsi)) ? 
                Kabupaten::where('provinsi_id', Provinsi::where('provinsi', old('provinsi', $jemaah->provinsi))->first()->id)->get() 
                : Kabupaten::all()
        ]);
    }

    public function updateJemaah(Request $request, $pemesananId, $jemaahId)
    {
        $jemaah = Jemaah::findOrFail($jemaahId);
        
        // MODIFIED: Validate request data
        $validateData = $request->validate([
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
        ]);

        try {
            // MODIFIED: Handle photo update
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($jemaah->foto && file_exists(public_path('storage/' . $jemaah->foto))) {
                    unlink(public_path('storage/' . $jemaah->foto));
                }
                
                // Store new photo
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Make sure the directory exists
                $path = public_path('storage/jemaah-foto');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                // Move the uploaded file
                $file->move($path, $filename);
                $validateData['foto'] = 'jemaah-foto/' . $filename;
            }

            $jemaah->update($validateData);

            return redirect()->route('pemesanan.jemaah.list', $pemesananId)
                ->with('success', 'Data jemaah berhasil diperbarui');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data jemaah: '.$e->getMessage());
        }
    }
    
}