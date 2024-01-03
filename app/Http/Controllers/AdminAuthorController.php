<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.author.index', [
            'title' => 'Data Author',
            'page' => 'author',
            'authors' => Author::with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.author.create', [
            'title' => 'Tambah Author',
            'page' => 'author',
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
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('user-photo');
            $validateUser['photo'] = $path;
        }
        $validateUser['role_id'] = 2;
        $user = User::create($validateUser);
        Author::create([
            'user_id' => $user->id,
        ]);
        return redirect('/admin/author')->with('success', 'Data Author berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {

        return view('admin.author.show', [
            'title' => 'Detail Author',
            'page' => 'author',
            'author' => $author,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {

        return view('admin.author.edit', [
            'title' => 'Edit Data Author',
            'page' => 'author',
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $user = $author->user;

        $validateUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number,' . $user->id, 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3145728',
            'password' => 'nullable|string|confirmed',
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

        return redirect('/admin/author')->with('success', 'Data Author berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {

        $author->user->delete();
        $author->delete();
        return redirect('/admin/author')->with('success', 'Data Author berhasil dihapus');
    }
}
