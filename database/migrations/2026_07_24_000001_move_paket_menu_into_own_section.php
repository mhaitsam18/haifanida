<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Package data is an operational area, not reference data, but the seeder's
 * fragile hardcoded parent_ids left "Data Paket" (and its siblings) under
 * "Master Data" on existing installs while "Manajemen Paket Wisata" sat empty.
 *
 * This reparents the package-domain menu rows into "Manajemen Paket Wisata".
 * A migration (not a seeder) because the rows already exist in production and
 * seeders don't re-run. Resolved by url/name so it is robust to the id drift
 * between installs, and idempotent.
 */
return new class extends Migration
{
    private array $paketUrls = ['/admin/paket', '/admin/galeri', '/admin/isu-perjalanan', '/admin/jadwal'];

    public function up(): void
    {
        $target = DB::table('menus')->where('menu', 'Manajemen Paket Wisata')->first();

        // Create the section if it doesn't exist, under the same top parent as Master Data.
        if (! $target) {
            $masterData = DB::table('menus')->where('menu', 'Master Data')->first();
            $topParent = $masterData->parent_id
                ?? DB::table('menus')->whereNull('parent_id')->value('id');

            $targetId = DB::table('menus')->insertGetId([
                'menu' => 'Manajemen Paket Wisata',
                'parent_id' => $topParent,
                'has_dropdown' => 1,
                'is_active' => 1,
                'url' => '#',
                'icon' => 'fa-solid fa-box-open',
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Mirror Master Data's role grants so visibility is unchanged.
            if ($masterData) {
                foreach (DB::table('menu_roles')->where('menu_id', $masterData->id)->get() as $grant) {
                    DB::table('menu_roles')->insert([
                        'menu_id' => $targetId,
                        'role_id' => $grant->role_id,
                        'can_view' => $grant->can_view,
                        'can_edit' => $grant->can_edit,
                        'can_delete' => $grant->can_delete,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        } else {
            $targetId = $target->id;
        }

        DB::table('menus')->whereIn('url', $this->paketUrls)->update(['parent_id' => $targetId]);
    }

    public function down(): void
    {
        // Move them back under Master Data (best-effort; leaves the section in place).
        $masterId = DB::table('menus')->where('menu', 'Master Data')->value('id');
        if ($masterId) {
            DB::table('menus')->whereIn('url', $this->paketUrls)->update(['parent_id' => $masterId]);
        }
    }
};
