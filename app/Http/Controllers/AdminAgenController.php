<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Kantor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAgenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.agen.index', [
            'title' => 'Data Agen',
            'page' => 'agen',
            'agens' => Agen::with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agen.create', [
            'title' => 'Tambah Agen',
            'page' => 'agen',
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
        $validateAgen = $request->validate([
            'kantor_id' => 'nullable',
        ]);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('user-photo');
            $validateUser['photo'] = $path;
        }
        $validateUser['role_id'] = 4;
        $user = User::create($validateUser);
        Agen::create([
            'user_id' => $user->id,
            'kantor_id' => $validateAgen['kantor_id'],
        ]);
        return redirect('/admin/agen')->with('success', 'Data Agen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agen $agen)
    {
        return view('admin.agen.show', [
            'title' => 'Detail Agen',
            'page' => 'agen',
            'agen' => $agen,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agen $agen)
    {
        return view('admin.agen.edit', [
            'title' => 'Edit Data Agen',
            'page' => 'agen',
            'agen' => $agen,
            'kantors' => Kantor::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agen $agen)
    {
        $user = $agen->user;

        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'password' => 'nullable|string|confirmed',
        ]);

        $validateAgen = $request->validate([
            'kantor_id' => 'nullable',
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
            $validateUser['password'] = $user->password;
        }

        $user->update($validateUser);

        $agen->update($validateAgen);

        return redirect('/admin/agen')->with('success', 'Data Agen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agen $agen)
    {
        $agen->user->delete();
        $agen->delete();
        return redirect('/admin/agen')->with('success', 'Data Agen berhasil dihapus');
    }
}
