<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kantor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admin.index', [
            'title' => 'Data Admin',
            'page' => 'admin',
            'admins' => Admin::with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create', [
            'title' => 'Tambah Admin',
            'page' => 'admin',
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number', 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'password' => 'required|string|confirmed',
        ]);

        $validateAdmin = $request->validate([
            'kantor_id' => 'nullable',
            'is_superadmin' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('user-photo');
            $validateUser['photo'] = $path;
        }

        $validateUser['role_id'] = 1;
        $validateUser['email_verified_at'] = now();
        $user = User::create($validateUser);

        Admin::create([
            'user_id' => $user->id,
            'kantor_id' => $validateAdmin['kantor_id'],
            'is_superadmin' => $validateAdmin['is_superadmin'],
        ]);

        return redirect('/admin/admin')->with('success', 'Data Admin berhasil ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admin.admin.show', [
            'title' => 'Detail Admin',
            'page' => 'admin',
            'admin' => $admin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.admin.edit', [
            'title' => 'Edit Data Admin',
            'page' => 'admin',
            'admin' => $admin,
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $user = $admin->user;

        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'password' => 'nullable|string|confirmed',
        ]);

        $validateAdmin = $request->validate([
            'kantor_id' => 'nullable',
            'is_superadmin' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('user-photo');
            $validateUser['photo'] = $path;
        } else {
            $validateUser['photo'] = $user->photo;
        }

        if (!empty($validateUser['password'])) {
            $validateUser['password'] = Hash::make($validateUser['password']);
        } else {
            // Jika password kosong, gunakan password yang sudah ada
            $validateUser['password'] = $user->password;
        }
        $user->update($validateUser);

        $admin->update($validateAdmin);

        return redirect('/admin/admin')->with('success', 'Data Admin berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->user->delete();
        $admin->delete();
        return redirect('/admin/admin')->with('success', 'Data Admin berhasil dihapus');
    }
}
