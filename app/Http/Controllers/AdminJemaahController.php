<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Jemaah;
use App\Models\Kabupaten;
use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminJemaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Paket $paket = null)
    {
        $jemaahs = Jemaah::query();

        if ($request->pemesanan_id) {
            $jemaahs->where('pemesanan_id', $request->pemesanan_id);
        }

        if ($request->grup_id) {
            $jemaahs->where('grup_id', $request->grup_id);
        }

        if ($request->mahram_id) {
            $jemaahs->where('mahram_id', $request->mahram_id);
        }



        if ($paket &&  (!$request->pemesanan_id && !$request->grup_id)) {
            $jemaahs->whereHas('pemesanan', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            })->orWhereHas('grup', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            });
        }

        $jemaahs = $jemaahs->paginate(200)->withQueryString();
        $jemaahs->load(['grup.paket.grups', 'pemesanan.paket.pemesanans']);

        // Data untuk modal "Tambah" (mengikuti perilaku create() sebelumnya: hanya terisi
        // kalau halaman diakses dengan query string ?pemesanan_id= atau ?grup_id=).
        $createPemesanan = $request->pemesanan_id ? Pemesanan::find($request->pemesanan_id) : null;
        $createGrup = $request->grup_id ? Grup::find($request->grup_id) : null;

        $createMahramCandidates = Jemaah::query();
        if ($paket && (!$request->pemesanan_id && !$request->grup_id)) {
            $createMahramCandidates->whereHas('pemesanan', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            })->orWhereHas('grup', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            });
        }
        if ($request->pemesanan_id) {
            $createMahramCandidates->where('pemesanan_id', $request->pemesanan_id);
        }
        if ($request->grup_id) {
            $createMahramCandidates->where('grup_id', $request->grup_id);
        }

        $editMahramCandidates = Jemaah::query();
        if ($paket) {
            $editMahramCandidates->whereHas('pemesanan', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            })->orWhereHas('grup', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            });
        }

        return view('admin.paket.jemaah.index', [
            'title' => 'Data jemaah',
            'page' => 'jemaah',
            'paket' => $paket,
            'jemaahs' => $jemaahs,
            'createPemesanans' => $createPemesanan ? $createPemesanan->paket->pemesanans : [],
            'createGrups' => $createGrup ? $createGrup->paket->grups : [],
            'createMahramCandidates' => $createMahramCandidates->get(),
            'editMahramCandidates' => $editMahramCandidates->get(),
            'provinsis' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'kabupaten_id' => 'nullable|integer',
            'provinsi_id' => 'nullable|integer',
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

        $validator->after(function ($validator) use ($request) {
            $this->validateKuotaGrup($validator, $request->grup_id);
        });

        $validateData = $validator->validate();

        if ($request->hasFile('foto')) {
            $validateData['foto'] = $request->file('foto')->store('jemaah-foto');
        }
        // Buat jemaah
        Jemaah::create($validateData);

        return back()->with('success', 'Data jemaah berhasil ditambahkan');
    }

    /**
     * Tolak jika grup sudah penuh (jumlah jemaah >= kuota_grup),
     * dikecualikan satu jemaah yang sedang diedit (bila ada).
     */
    private function validateKuotaGrup($validator, $grupId, $excludeJemaahId = null)
    {
        if (! $grupId) {
            return;
        }

        $grup = Grup::find($grupId);

        if (! $grup || $grup->kuota_grup === null) {
            return;
        }

        $jumlahJemaah = Jemaah::where('grup_id', $grupId)
            ->when($excludeJemaahId, fn ($query) => $query->where('id', '!=', $excludeJemaahId))
            ->count();

        if ($jumlahJemaah >= $grup->kuota_grup) {
            $validator->errors()->add('grup_id', "Grup {$grup->nama_grup} sudah penuh ({$jumlahJemaah}/{$grup->kuota_grup}).");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket = null, Jemaah $jemaah)
    {
        $jemaah->load(['berkasJemaahs.berkas', 'kamarJemaahs.kamar.paketHotel.hotel']);

        return view('admin.paket.jemaah.show', [
            'title' => 'Detail jemaah',
            'page' => 'jemaah',
            'paket' => $paket,
            'jemaah' => $jemaah,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jemaah $jemaah)
    {
        $validator = Validator::make($request->all(), [
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
            'kabupaten_id' => 'nullable|integer',
            'provinsi_id' => 'nullable|integer',
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

        $validator->after(function ($validator) use ($request, $jemaah) {
            $this->validateKuotaGrup($validator, $request->grup_id, $jemaah->id);
        });

        $validateData = $validator->validate();

        if ($request->hasFile('foto')) {
            $validateData['foto'] = $request->file('foto')->store('jemaah-foto');
        } else {
            $validateData['foto'] = $jemaah->foto;
        }
        // Buat jemaah
        $jemaah->update($validateData);

        return back()->with('success', 'Data jemaah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jemaah $jemaah)
    {
        $jemaah->delete();
        return back()->with('success', 'Data jemaah berhasil dihapus');
    }
}
