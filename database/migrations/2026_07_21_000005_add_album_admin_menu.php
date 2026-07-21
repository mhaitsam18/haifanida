<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Data migration: registers "Manajemen Album" in the admin sidebar next to
 * the existing (inactive) per-paket "Galeri" entry, copying that entry's
 * placement and any role grants. Resolved dynamically — live ids differ
 * from seeder ids.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('menus')->where('url', '/admin/album')->exists()) {
            return;
        }

        $sibling = DB::table('menus')->where('url', '/admin/galeri')->first();
        $parent = $sibling?->parent_id
            ? DB::table('menus')->where('id', $sibling->parent_id)->first()
            : DB::table('menus')->where('menu', 'Manajemen Paket Wisata')->first();

        $menuId = DB::table('menus')->insertGetId([
            'menu' => 'Manajemen Album',
            'parent_id' => $parent?->id,
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/album',
            'icon' => '',
            'order' => $sibling ? ((int) $sibling->order + 1) : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($sibling) {
            $grants = DB::table('menu_roles')->where('menu_id', $sibling->id)->get();
            foreach ($grants as $grant) {
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
        $menu = DB::table('menus')->where('url', '/admin/album')->first();
        if ($menu) {
            DB::table('menu_roles')->where('menu_id', $menu->id)->delete();
            DB::table('menus')->where('id', $menu->id)->delete();
        }
    }
};
