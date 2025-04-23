<?php

namespace App\Http\Controllers;

use App\Models\MenuRole;
use Illuminate\Http\Request;

class MenuRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // Loop through submitted data and create/update menu_roles
        // foreach ($request->menu_id as $key => $menuId) {
        //     $data = [
        //         'menu_id' => $menuId,
        //         'role_id' => $request->role_id[$key],
        //         'can_view' => $request->has('can_view') && in_array($menuId, $request->can_view),
        //         'can_edit' => $request->has('can_edit') && in_array($menuId, $request->can_edit),
        //         'can_delete' => $request->has('can_delete') && in_array($menuId, $request->can_delete),
        //     ];

        //     // Use appropriate logic to create or update records in menu_roles table
        //     // For example, you can use MenuRole::updateOrCreate() method
        //     MenuRole::updateOrCreate(
        //         ['menu_id' => $menuId, 'role_id' => $request->role_id[$key]],
        //         $data
        //     );
        // }

        // // Redirect back or to a specific page
        // return redirect()->back()->with('success', 'Permissions saved successfully.');
        $menuId = $request->input('menu_id');
        $roleId = $request->input('role_id');

        // Use appropriate logic to create or update records in menu_roles table
        // For example, you can use MenuRole::updateOrCreate() method
        $where = ['menu_id' => $menuId, 'role_id' => $roleId];
        $update = [];
        if (isset($request->can_view)) {
            $update['can_view'] = $request->input('can_view');
        }
        if (isset($request->can_edit)) {
            $update['can_edit'] = $request->input('can_edit');
        }
        if (isset($request->can_delete)) {
            $update['can_delete'] = $request->input('can_delete');
        }
        MenuRole::updateOrCreate($where, $update);

        // Respond with a success message
        return response()->json(['success' => 'Permissions saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuRole $menuRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuRole $menuRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuRole $menuRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuRole $menuRole)
    {
        //
    }
}
