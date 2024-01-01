<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run(): void
    {
        $menus = ['Main', 'Superadmin', 'Adminkantor'];
        foreach ($menus as $key => $value) {
            Menu::create([
                'menu' => $value,
                'has_dropdown' => 1,
                'is_active' => 1,
                'order' => ($key + 1) . "000",
                'indelible' => 1
            ]);
        }
        $submenus1 = [
            "Dashboard" => [
                'parent_id' => 1,
                'url' => '/admin/index',
                'icon' => 'fa-solid fa-tachograph-digital',
            ],
            "Akun Saya" => [
                'parent_id' => 1,
                'icon' => 'fa-solid fa-user',
            ],
            "Autentikasi & Otorisasi" => [
                'parent_id' => 2,
                'icon' => 'fa-solid fa-face-smile',
            ],
            "Manajemen Pengguna" => [
                'parent_id' => 2,
                'icon' => 'fa-solid fa-user',
            ],
            "Manajemen Aplikasi" => [
                'parent_id' => 2,
                'icon' => 'fa-regular fa-window-restore',
            ],
            "Manajemen Kantor" => [
                'parent_id' => 2,
                'icon' => 'fa-solid fa-building',
            ],
            "Master Data" => [
                'parent_id' => 2,
                'icon' => 'fa-solid fa-database',
            ],
            "Kantor Saya" => [
                'parent_id' => 3,
                'url' => '/admin/kantor-saya',
                'icon' => 'fa-solid fa-house-user',
            ],
            "Manajemen Paket Wisata" => [
                'parent_id' => 3,
                'icon' => 'fa-solid fa-box-open',
            ],
            "Manajemen Jema'ah" => [
                'parent_id' => 3,
                'icon' => 'fa-solid fa-person-praying',
            ],
            "Manajemen Grup" => [
                'parent_id' => 3,
                'icon' => 'fa-solid fa-people-group',
            ],
            "Pelayanan" => [
                'parent_id' => 3,
                'icon' => 'fa-solid fa-handshake-angle',
            ]
        ];
        $index = 1;
        $old_parent = 1;
        foreach ($submenus1 as $key => $value) {
            if ($value['parent_id'] != $old_parent) {
                $old_parent = $value['parent_id'];
                $index = 1;
            }
            Menu::create([
                'menu' => $key,
                'parent_id' => $value['parent_id'],
                'has_dropdown' => isset($value['url']) ? 0 : 1,
                'is_active' => 1,
                'url' => isset($value['url']) ? $value['url'] : '#',
                'icon' => $value['icon'],
                'order' => $value['parent_id'] . $index++ . '00'
            ]);
        }
        Menu::create([
            'menu' => "Profil Saya",
            'parent_id' => '5',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/profile',
            'icon' => '',
            'order' => 1101
        ]);
        Menu::create([
            'menu' => "Saran dan Keluhan",
            'parent_id' => '5',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/pesan',
            'icon' => '',
            'order' => 1102
        ]);
        Menu::create([
            'menu' => "Manajemen Role",
            'parent_id' => '6',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/role',
            'icon' => '',
            'order' => 2101
        ]);
        Menu::create([
            'menu' => "Manajemen Akses",
            'parent_id' => '6',
            'has_dropdown' => 0,
            'is_active' => 0,
            'url' => '/admin/role-menu',
            'icon' => '',
            'order' => 2102
        ]);
        Menu::create([
            'menu' => "Data Admin",
            'parent_id' => '7',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/user-admin',
            'icon' => '',
            'order' => 2201
        ]);
        Menu::create([
            'menu' => "Data Author",
            'parent_id' => '7',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/author',
            'icon' => '',
            'order' => 2202
        ]);
        Menu::create([
            'menu' => "Data Member",
            'parent_id' => '7',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/member',
            'icon' => '',
            'order' => 2203
        ]);
        Menu::create([
            'menu' => "Data Agen",
            'parent_id' => '7',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/agen',
            'icon' => '',
            'order' => 2204
        ]);
        Menu::create([
            'menu' => "Manajemen Menu",
            'parent_id' => '8',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/menu',
            'icon' => '',
            'order' => 2301
        ]);
        Menu::create([
            'menu' => "Manajemen Sub Menu",
            'parent_id' => '8',
            'has_dropdown' => 0,
            'is_active' => 0,
            'url' => '/admin/sub-menu',
            'icon' => '',
            'order' => 2302
        ]);
        Menu::create([
            'menu' => "Manajemen Konten",
            'parent_id' => '8',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/konten',
            'icon' => '',
            'order' => 2303
        ]);
        Menu::create([
            'menu' => "Manajemen Kantor",
            'parent_id' => '9',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/kantor',
            'icon' => '',
            'order' => 2401
        ]);
        Menu::create([
            'menu' => "Manajemen Perwakilan",
            'parent_id' => '9',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/perwakilan',
            'icon' => '',
            'order' => 2402
        ]);
        Menu::create([
            'menu' => "Manajemen Cabang",
            'parent_id' => '9',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/cabang',
            'icon' => '',
            'order' => 2403
        ]);
        Menu::create([
            'menu' => "Data Hotel",
            'parent_id' => '10',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/hotel',
            'icon' => '',
            'order' => 2501
        ]);
        Menu::create([
            'menu' => "Data Maskapai",
            'parent_id' => '10',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/maskapai',
            'icon' => '',
            'order' => 2502
        ]);
        Menu::create([
            'menu' => "Data Paket",
            'parent_id' => '12',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/paket',
            'icon' => '',
            'order' => 3101
        ]);
        Menu::create([
            'menu' => "Galeri",
            'parent_id' => '12',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/galeri',
            'icon' => '',
            'order' => 3102
        ]);
        Menu::create([
            'menu' => "Isu Perjalanan",
            'parent_id' => '12',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/isu-perjalanan',
            'icon' => '',
            'order' => 3103
        ]);
        Menu::create([
            'menu' => "Jadwal",
            'parent_id' => '12',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/jadwal',
            'icon' => '',
            'order' => 3104
        ]);
        Menu::create([
            'menu' => "Data Jema'ah",
            'parent_id' => '13',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/jemaah',
            'icon' => '',
            'order' => 3201
        ]);


        MenuRole::create([
            'menu_id' => 1,
            'role_id' => 1,
            'can_view' => 1,
            'can_edit' => 1,
            'can_delete' => 1,
        ]);
        MenuRole::create([
            'menu_id' => 2,
            'role_id' => 5,
            'can_view' => 1,
            'can_edit' => 1,
            'can_delete' => 1,
        ]);
        MenuRole::create([
            'menu_id' => 3,
            'role_id' => 6,
            'can_view' => 1,
            'can_edit' => 1,
            'can_delete' => 1,
        ]);
    }
}
