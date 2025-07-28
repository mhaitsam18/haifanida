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
        $member = Member::where('user_id', $user->id)->first();

        // Validate User data
        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'password' => 'nullable|string'
        ]);

        // Validate Member data
        $validateMember = $request->validate([
            'nomor_ktp' => 'nullable|string',
            'nama_sesuai_paspor' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'kewarganegaraan' => 'nullable|in:WNI,WNA',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'tingkat_pendidikan' => 'nullable|in:SD,SLTP,SLTA,D1/D2/D3,D4/S1,S2,S3',
            'pekerjaan' => 'nullable|string',
            'nomor_paspor' => 'nullable|string',
            'tempat_dikeluarkan' => 'nullable|string',
            'tanggal_dikeluarkan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'pernah_umroh' => 'nullable|boolean',
            'pernah_haji' => 'nullable|boolean',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'nama_keluarga_terdekat' => 'nullable|string',
            'kontak_keluarga_terdekat' => 'nullable|string'
        ]);

        // Handle password
        if (!empty($validateUser['password'])) {
            $validateUser['password'] = Hash::make($validateUser['password']);
        } else {
            unset($validateUser['password']);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/user-photo/' . $user->photo);
            }

            // Store new photo
            $validateUser['photo'] = $request->file('photo')->store('user-photo', 'public');
            $validateMember['foto'] = $validateUser['photo'];
        }

        // Update user data
        $user->update($validateUser);

        // Sync member profile fields with user fields
        $validateMember['nama_lengkap'] = $user->name;
        $validateMember['email'] = $user->email;
        $validateMember['nomor_telepon'] = $user->phone_number;

        // Update member data
        $member->update($validateMember);

        return redirect()->route('member.profile', ['mode' => 'show'])->with('success', 'Profile berhasil diperbarui');
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
        $member = Member::where('user_id', $user->id)->first();

        // Get provinsis
        $provinsis = Provinsi::all();

        // Get kabupatens if provinsi is selected
        $kabupatens = [];
        if ($member->provinsi) {
            $provinsi = Provinsi::where('provinsi', $member->provinsi)->first();
            if ($provinsi) {
                $kabupatens = Kabupaten::where('provinsi_id', $provinsi->id)->get();
            }
        }

        return view('home.identitas', [
            'user' => $user,
            'title' => 'Identitas dan Berkas',
            'member' => $member,
            'provinsis' => $provinsis,
            'kabupatens' => $kabupatens
        ]);
    }

    public function updateIdentitas(Request $request)
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();

        // Validate User data
        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
        ]);

        // Validate Member data
        $validateMember = $request->validate([
            'nomor_ktp' => 'nullable|string|max:16',
            'nama_sesuai_paspor' => 'nullable|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
            'tingkat_pendidikan' => 'required|in:SD,SLTP,SLTA,D1/D2/D3,D4/S1,S2,S3',
            'pekerjaan' => 'required|string',
            'nomor_paspor' => 'nullable|string',
            'tempat_dikeluarkan' => 'nullable|string',
            'tanggal_dikeluarkan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'pernah_umroh' => 'nullable|boolean',
            'pernah_haji' => 'nullable|boolean',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'nama_keluarga_terdekat' => 'required|string',
            'kontak_keluarga_terdekat' => 'required|string'
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($member->foto) {
                Storage::delete('jemaah-foto/' . $member->foto);
            }

            // Store new foto
            $validateMember['foto'] = $request->file('foto')->store('jemaah-foto', 'public');
        }

        // Update user data
        $user->update($validateUser);

        // Sync member profile fields with user fields
        $validateMember['nama_lengkap'] = $user->name;
        $validateMember['email'] = $user->email;
        $validateMember['nomor_telepon'] = $user->phone_number;

        // Update member data
        $member->update($validateMember);

        return redirect()->route('member.profile', ['mode' => 'show'])->with('success', 'Data identitas berhasil diperbarui');
    }
    // --MODIFIED
    public function update(Request $request, Member $member)
    {
        $user = $member->user;
        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
        ]);

        $validateMember = $request->validate([
            'nomor_ktp' => 'nullable|string',
            'nama_sesuai_paspor' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'kewarganegaraan' => 'nullable|in:WNI,WNA',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'tingkat_pendidikan' => 'nullable|in:SD,SLTP,SLTA,D1/D2/D3,D4/S1,S2,S3',
            'pekerjaan' => 'nullable|string',
            'nomor_paspor' => 'nullable|string',
            'tempat_dikeluarkan' => 'nullable|string',
            'tanggal_dikeluarkan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'pernah_umroh' => 'nullable|boolean',
            'pernah_haji' => 'nullable|boolean',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'nama_keluarga_terdekat' => 'nullable|string',
            'kontak_keluarga_terdekat' => 'nullable|string',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            // Store new photo in user-photo directory
            $validateUser['photo'] = $request->file('photo')->store('user-photo', 'public');
            $validateMember['foto'] = $validateUser['photo'];
        }

        // Password remains unchanged
        $validateUser['password'] = $user->password;

        // Update user data
        $user->update($validateUser);

        // Update member data
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
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            // Store new photo in user-photo directory
            $validateUser['photo'] = $request->file('photo')->store('user-photo', 'public');
            $validateMember['foto'] = $validateUser['photo'];
            $user->update($validateUser);
            // $user->member->update($validateMember);

            return redirect()->back()->with('success', 'Profile picture updated successfully!');
        }

        // if ($request->hasFile('photo')) {
        //     // Delete old photo if exists
        //     if ($user->photo) {
        //         $oldPhotoPath = public_path('storage/user-photo/' . $user->photo);
        //         if (file_exists($oldPhotoPath)) {
        //             unlink($oldPhotoPath);
        //         }
        //     }

        //     // Store new photo
        //     $file = $request->file('photo');
        //     $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();

        //     // Move file to public/storage/user-photo directory
        //     $file->move(public_path('storage/user-photo'), $filename);

        //     // Update user profile with just the filename
        //     $user->photo = $filename;
        //     $user->save();

        //     return redirect()->back()->with('success', 'Profile picture updated successfully!');
        // }

        return redirect()->back()->with('error', 'No image file uploaded.');
    }
}
