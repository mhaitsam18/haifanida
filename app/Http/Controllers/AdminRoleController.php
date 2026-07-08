<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        $tree = Menu::with(['children.children'])
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        $flattened = collect();
        $flatten = function ($menus, $depth) use (&$flatten, &$flattened) {
            foreach ($menus as $menu) {
                $flattened->push(['menu' => $menu, 'depth' => $depth]);
                $flatten($menu->children, $depth + 1);
            }
        };
        $flatten($tree, 0);

        return view('admin.role.show', [
            'title' => 'Detail role: ' . $role->role,
            'page' => 'role',
            'role' => $role,
            'menuRows' => $flattened,
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
