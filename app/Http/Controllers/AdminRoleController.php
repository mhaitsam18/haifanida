<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.role.index', [
            'title' => 'Data role',
            'page' => 'role',
            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create', [
            'title' => 'Tambah role',
            'page' => 'role',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ]);
        Role::create([
            'role' => $request->role,
        ]);
        return redirect('/admin/role')->with('success', 'Data Role berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.role.show', [
            'title' => 'Detail role',
            'page' => 'role',
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'title' => 'Detail role',
            'page' => 'role',
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role' => 'required',
        ]);
        $role->update([
            'role' => $request->role,
        ]);
        return redirect('/admin/role')->with('success', 'Data Role berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect('/admin/role')->with('success', 'Data Role berhasil dihapus');
    }
}
