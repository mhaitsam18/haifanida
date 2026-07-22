<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Registers the "Sinkronisasi Hotel" admin sidebar entry next to hotel
 * management, copying that entry's placement + role grants. Resolved
 * dynamically (live ids differ from seeder ids).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('menus')->where('url', '/admin/hotel-sync')->exists()) {
            return;
        }

        $sibling = DB::table('menus')->where('url', '/admin/hotel')->first();
        $parentId = $sibling?->parent_id
            ?? DB::table('menus')->where('menu', 'Master Data')->value('id');

        $menuId = DB::table('menus')->insertGetId([
            'menu' => 'Sinkronisasi Hotel',
            'parent_id' => $parentId,
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/hotel-sync',
            'icon' => '',
            'order' => $sibling ? ((int) $sibling->order + 1) : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($sibling) {
            foreach (DB::table('menu_roles')->where('menu_id', $sibling->id)->get() as $grant) {
                DB::table('menu_roles')->insert([
                    'menu_id' => $menuId,
                    'role_id' => $grant->role_id,
                    'can_view' => $grant->can_view,
                    'can_edit' => $grant->can_edit,
                    'can_delete' => $grant->can_delete,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $menu = DB::table('menus')->where('url', '/admin/hotel-sync')->first();
        if ($menu) {
            DB::table('menu_roles')->where('menu_id', $menu->id)->delete();
            DB::table('menus')->where('id', $menu->id)->delete();
        }
    }
};
