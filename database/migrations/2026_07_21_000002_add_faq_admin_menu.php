<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Data migration: registers the "Kelola FAQ" entry in the admin sidebar
 * (menus table) under "Manajemen Aplikasi", and copies the role grants
 * (menu_roles) from the sibling "Manajemen Konten" row so whoever can
 * manage content can manage FAQs. Everything is resolved dynamically —
 * live ids differ from seeder ids.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('menus')->where('url', '/admin/faq')->exists()) {
            return;
        }

        $parent = DB::table('menus')->where('menu', 'Manajemen Aplikasi')->first();
        $sibling = DB::table('menus')->where('url', '/admin/konten')->first();

        $menuId = DB::table('menus')->insertGetId([
            'menu' => 'Kelola FAQ',
            'parent_id' => $parent?->id,
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/faq',
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
        $menu = DB::table('menus')->where('url', '/admin/faq')->first();
        if ($menu) {
            DB::table('menu_roles')->where('menu_id', $menu->id)->delete();
            DB::table('menus')->where('id', $menu->id)->delete();
        }
    }
};
