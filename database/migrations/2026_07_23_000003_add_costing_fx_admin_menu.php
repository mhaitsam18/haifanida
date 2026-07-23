<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Registers the "Kurs Kebijakan (FX)" admin sidebar entry under Master Data.
 * FX is HPP-adjacent, so it is granted only to office-admin roles
 * (superadmin, adminkantor) — never to agen. Resolved dynamically because
 * live menu ids differ from seeder ids.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('menus')->where('url', '/admin/fx-policy')->exists()) {
            return;
        }

        $parentId = DB::table('menus')->where('menu', 'Master Data')->value('id')
            ?? DB::table('menus')->whereNull('parent_id')->value('id');

        $menuId = DB::table('menus')->insertGetId([
            'menu' => 'Kurs Kebijakan (FX)',
            'parent_id' => $parentId,
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/fx-policy',
            'icon' => '',
            'order' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $roleIds = DB::table('roles')
            ->whereIn('role', ['superadmin', 'adminkantor'])
            ->pluck('id');

        foreach ($roleIds as $roleId) {
            DB::table('menu_roles')->insert([
                'menu_id' => $menuId,
                'role_id' => $roleId,
                'can_view' => 1,
                'can_edit' => 1,
                'can_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        $menu = DB::table('menus')->where('url', '/admin/fx-policy')->first();
        if ($menu) {
            DB::table('menu_roles')->where('menu_id', $menu->id)->delete();
            DB::table('menus')->where('id', $menu->id)->delete();
        }
    }
};
