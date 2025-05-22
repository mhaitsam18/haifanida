<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// MODIFIED--
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Member;
use App\Models\Provinsi;
use App\Models\Kabupaten;
// --MODIFIED

class MemberController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Beranda | Haifa Nida Wisata',
            'page' => 'beranda',
        ]);
    }

    public function profile(Request $request){
        $user = Auth::user();
        $mode = $request->query('mode', 'show');
        // MODIFIED--
        $title = 'Profile | Haifa Nida Wisata';
        return view('home.profile', compact('user', 'mode', 'title'));
        // --MODIFIED
    }

    // MODIFIED--
    // fungsi untuk view perjalanan saya
    public function perjalananSaya(Request $request){
        $user = Auth::user();
        $title = 'Perjalanan Saya | Haifa Nida Wisata';
        // MODIFIED--
        $pemesanan = $user->pemesanans()->with('paket')->get();
        // --MODIFIED
        return view('home.perjalanan-saya', compact('user', 'title', 'pemesanan'));
    }
    // --MODIFIED

    // MODIFIED--
    public function tagihan(Request $request){
        $user = Auth::user();
        $title = 'Tagihan | Haifa Nida Wisata';

        $tagihan = $user->pemesanans()->with('pembayarans.pemesanan.paket')->get()->flatMap->pembayarans;

        return view('home.tagihan', compact('user', 'title', 'tagihan'));
    }
    // --MODIFIED
    // MODIFIED--

    public function identitas(Request $request){
        $user = Auth::user();
        // $title = "Identitas dan Berkas | Haifa Nida Wisata";
        // $member = Member::where('user_id', $user->id)->first();
        // $provinsis = Provinsi::all();

        return view('home.identitas', 
        ['user' => Auth::user(),
         'title' => 'Identitas dan Berkas',
         'member' => Member::where('user_id', $user->id)->first(),
         'provinsis' => Provinsi::all(),
         'kabupatens' => (old('provinsi')) ? Kabupaten::where('provinsi_id', Provinsi::where('provinsi', old('provinsi'))->first()->id)->get() : Kabupaten::all(),]);
    }

    public function update(Request $request, Member $member)
    {
        $user = $member->user;
        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'password' => 'nullable|string|confirmed',
        ]);

        $validateMember = $request->validate([
            'nomor_ktp' => 'nullable|string',
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
            'tingkat_pendidikan' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'nomor_paspor' => 'nullable|string',
            'tempat_dikeluarkan' => 'nullable|string',
            'tanggal_dikeluarkan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'pernah_umroh' => 'nullable|boolean',
            'pernah_haji' => 'nullable|boolean',
            // 'hubungan_mahram' => 'nullable|string',
            'golongan_darah' => 'nullable|string',
            'nama_keluarga_terdekat' => 'nullable|string',
            'kontak_keluarga_terdekat' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validateUser['photo'] = $request->file('photo')->store('user-photo');
            $validateMember['foto'] = $request->file('photo')->store('member-foto');
        } else {
            $validateUser['photo'] = $user->photo;
            $validateMember['foto'] = $member->foto;
        }

        if (!empty($validateUser['password'])) {
            $validateUser['password'] = Hash::make($validateUser['password']);
        } else {
            $validateUser['password'] = $user->password;
        }

        $user->update($validateUser);

        $validateMember['nama_lengkap'] = $user->name;
        $validateMember['email'] = $user->email;
        $validateMember['nomor_telepon'] = $user->phone_number;

        $member->update($validateMember);

        return back()->with('success', 'Data Member berhasil diperbarui');
    }

    // --MODIFIED
}
