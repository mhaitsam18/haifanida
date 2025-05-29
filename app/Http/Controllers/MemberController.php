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
use App\Models\User;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
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

    public function profile(Request $request)
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        $mode = $request->query('mode', 'show');
        $title = 'Profile | Haifa Nida Wisata';
        return view('home.profile', compact('user', 'member', 'mode', 'title'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => 'nullable|string|unique:users,phone_number,' . $user->id,
            'password' => 'nullable|string'
        ]);

        // Handle password
        if (!empty($validateUser['password'])) {
            $validateUser['password'] = Hash::make($validateUser['password']);
        } else {
            unset($validateUser['password']);
        }

        // Update user data
        $user->name = $validateUser['name'];
        $user->email = $validateUser['email'];
        $user->username = $validateUser['username'];
        $user->phone_number = $validateUser['phone_number'];
        if (isset($validateUser['password'])) {
            $user->password = $validateUser['password'];
        }
        $user->save();

        // Update member data if exists
        if ($member = Member::where('user_id', $user->id)->first()) {
            $member->update([
                'nama_lengkap' => $validateUser['name'],
                'email' => $validateUser['email'],
                'nomor_telepon' => $validateUser['phone_number']
            ]);
        }

        return redirect()->route('member.profile', ['mode' => 'show'])->with('success', 'Profile updated successfully!');
    }

    // Daftar keberangkatan - menampilkan perjalanan yang akan datang
    public function daftarKeberangkatan(Request $request)
    {
        $user = Auth::user();
        $title = 'Daftar Keberangkatan | Haifa Nida Wisata';
        
        // Get upcoming trips where end date is in the future
        $pemesanan = $user->pemesanans()
            ->with('paket')
            ->whereHas('paket', function($query) {
                $query->where('tanggal_selesai', '>=', Carbon::now());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.daftar-keberangkatan', compact('user', 'title', 'pemesanan'));
    }

    // Riwayat perjalanan - menampilkan perjalanan yang sudah selesai
    public function riwayatPerjalanan(Request $request)
    {
        $user = Auth::user();
        $title = 'Riwayat Perjalanan | Haifa Nida Wisata';
        
        // Get completed trips where end date is in the past
        $pemesanan = $user->pemesanans()
            ->with('paket')
            ->whereHas('paket', function($query) {
                $query->where('tanggal_selesai', '<', Carbon::now());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.perjalanan-saya', compact('user', 'title', 'pemesanan'));
    }

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

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                $oldPhotoPath = public_path('storage/user-photo/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Store new photo
            $file = $request->file('photo');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            
            // Move file to public/storage/user-photo directory
            $file->move(public_path('storage/user-photo'), $filename);

            // Update user profile with just the filename
            $user->photo = $filename;
            $user->save();

            return redirect()->back()->with('success', 'Profile picture updated successfully!');
        }

        return redirect()->back()->with('error', 'No image file uploaded.');
    }
}
