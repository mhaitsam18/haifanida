<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.menu.index', [
            'title' => 'Data Menu',
            'page' => 'menu',
            'menus' => Menu::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create', [
            'title' => 'Tambah Menu',
            'page' => 'menu',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'parent_id' => 'nullable',
            'menu' => 'required',
            'has_dropdown' => 'nullable',
            'is_active' => 'nullable',
            'url' => 'nullable',
            'icon' => 'nullable',
            'order' => 'required',
        ]);
        menu::create($validateData);
        return redirect('/admin/menu')->with('success', 'Data Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menu.show', [
            'title' => 'Detail Menu',
            'page' => 'menu',
            'menu' => $menu,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', [
            'title' => 'Edit Menu',
            'page' => 'menu',
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validateData = $request->validate([
            'parent_id' => 'nullable',
            'menu' => 'required',
            'has_dropdown' => 'nullable',
            'is_active' => 'nullable',
            'url' => 'nullable',
            'icon' => 'nullable',
            'order' => 'required',
        ]);
        $menu->update($validateData);
        return redirect('/admin/menu')->with('success', 'Data Menu berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect('/admin/menu')->with('success', 'Data Menu berhasil dihapus');
    }
}
