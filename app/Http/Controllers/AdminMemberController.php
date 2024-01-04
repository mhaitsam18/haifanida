<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.member.index', [
            'title' => 'Data member',
            'page' => 'member',
            'members' => Member::with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.member.create', [
            'title' => 'Tambah member',
            'page' => 'member',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi untuk User
        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number', 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'password' => 'required|string|confirmed',
        ]);

        $validateMember = $request->validate([
            'nomor_ktp' => 'nullable|string',
            // 'nama_lengkap' => 'nullable|string',
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
            // 'email' => 'nullable|string',
            // 'nomor_telepon' => 'nullable|string',
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
            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'nama_keluarga_terdekat' => 'nullable|string',
            'kontak_keluarga_terdekat' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validateUser['photo'] = $request->file('photo')->store('user-photo');
            $validateMember['foto'] = $request->file('photo')->store('member-foto');
        }
        // if ($request->hasFile('foto')) {
        //     $path = $request->file('foto')->store('member-foto');
        //     $validateMember['foto'] = $path;
        // }

        // Tambahkan role_id untuk User
        $validateUser['role_id'] = 3; // Role ID for "member"

        // Buat User
        $user = User::create($validateUser);

        // Tambahkan user_id untuk Member
        $validateMember['user_id'] = $user->id;
        $validateMember['nama_lengkap'] = $user->name;
        $validateMember['email'] = $user->email;
        $validateMember['nomor_telepon'] = $user->phone_number;

        // Buat Member
        Member::create($validateMember);

        return redirect('/admin/member')->with('success', 'Data Member berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {

        return view('admin.member.show', [
            'title' => 'Detail member',
            'page' => 'member',
            'member' => $member,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('admin.member.edit', [
            'title' => 'Edit member',
            'page' => 'member',
            'member' => $member,
            'provinsis' => Provinsi::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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
            'nomor_ktp' => 'required|string',
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
            'hubungan_mahram' => 'nullable|string',
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

        return redirect('/admin/member')->with('success', 'Data Member berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->user->delete();
        $member->delete();
        return redirect('/admin/member')->with('success', 'Data Member berhasil dihapus');
    }
}
