<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Jemaah;
use App\Models\Kabupaten;
use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\Provinsi;
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

        $jemaahs = $jemaahs->get();

        return view('admin.paket.jemaah.index', [
            'title' => 'Data jemaah',
            'page' => 'jemaah',
            'paket' => $paket,
            'jemaahs' => $jemaahs
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Paket $paket = null)
    {
        $pemesanan = null;
        $grup = null;
        if ($request->pemesanan_id) {
            $pemesanan = Pemesanan::find($request->pemesanan_id);
        }
        if ($request->grup_id) {
            $grup = Grup::find($request->grup_id);
        }

        $jemaahs = Jemaah::query();




        if ($paket &&  (!$request->pemesanan_id && !$request->grup_id)) {
            $jemaahs->whereHas('pemesanan', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            })->orWhereHas('grup', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            });
        }

        if ($request->pemesanan_id) {
            $jemaahs->where('pemesanan_id', $request->pemesanan_id);
        }
        if ($request->grup_id) {
            $jemaahs->where('grup_id', $request->grup_id);
        }

        $jemaahs = $jemaahs->get();

        return view('admin.paket.jemaah.create', [
            'title' => 'Data jemaah',
            'page' => 'jemaah',
            'paket' => $paket,
            'jemaahs' => $jemaahs,
            'pemesanans' => $pemesanan ? $pemesanan->paket->pemesanans : [],
            'grups' => $grup ? $grup->paket->grups : [],
            'provinsis' => Provinsi::all(),
            'kabupatens' => (old('provinsi')) ? Kabupaten::where('provinsi_id', Provinsi::where('provinsi', old('provinsi'))->first()->id)->get() : Kabupaten::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        if ($request->hasFile('foto')) {
            $validateData['foto'] = $request->file('foto')->store('jemaah-foto');
        }
        // Buat jemaah
        Jemaah::create($validateData);

        return back()->with('success', 'Data jemaah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket = null, Jemaah $jemaah)
    {
        return view('admin.paket.jemaah.show', [
            'title' => 'Detail jemaah',
            'page' => 'jemaah',
            'paket' => $paket,
            'jemaah' => $jemaah,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket = null, Jemaah $jemaah)
    {
        $pemesanan = optional($jemaah->pemesanan);
        $grup = optional($jemaah->grup);


        $jemaahs = Jemaah::query();


        if ($paket) {
            $jemaahs->whereHas('pemesanan', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            })->orWhereHas('grup', function ($query) use ($paket) {
                $query->where('paket_id', $paket->id);
            });
        }

        // if ($request->pemesanan_id) {
        //     $jemaahs->where('pemesanan_id', $request->pemesanan_id);
        // }

        // if ($request->grup_id) {
        //     $jemaahs->where('grup_id', $request->grup_id);
        // }

        $jemaahs = $jemaahs->get();

        return view('admin.paket.jemaah.edit', [
            'title' => 'Edit jemaah',
            'page' => 'jemaah',
            'jemaah' => $jemaah,
            'paket' => $paket,
            'jemaahs' => $jemaahs,
            'pemesanans' => $pemesanan->paket->pemesanans ?? [],
            'grups' => $grup->paket->grups ?? [],
            'provinsis' => Provinsi::all(),
            'kabupatens' => (old('provinsi', $jemaah->provinsi)) ? Kabupaten::where('provinsi_id', Provinsi::where('provinsi', old('provinsi', $jemaah->provinsi))->first()->id)->get() : Kabupaten::all(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jemaah $jemaah)
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
