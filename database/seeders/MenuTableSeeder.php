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
        Menu::create([
            'menu' => 'Main',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '',
            'icon' => '',
            'order' => 1000,
            'indelible' => 1
        ]);
        Menu::create([
            'menu' => 'Superadmin',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '',
            'icon' => '',
            'order' => 2000,
            'indelible' => 1
        ]);
        Menu::create([
            'menu' => 'Adminkantor',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '',
            'icon' => '',
            'order' => 3000,
            'indelible' => 1
        ]);
        Menu::create([
            'menu' => 'Dashboard',
            'parent_id' => '1',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/index',
            'icon' => 'fa-solid fa-tachograph-digital',
            'order' => 1100
        ]);
        Menu::create([ //5
            'menu' => 'Akun Saya',
            'parent_id' => '1',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-user',
            'order' => 1200
        ]);
        Menu::create([
            'menu' => 'Autentikasi & Otorisasi',
            'parent_id' => '2',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-face-smile',
            'order' => 2100
        ]);
        Menu::create([
            'menu' => 'Manajemen Pengguna',
            'parent_id' => '2',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-users',
            'order' => 2200
        ]);
        Menu::create([
            'menu' => 'Manajemen Aplikasi',
            'parent_id' => '2',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-regular fa-window-restore',
            'order' => 2300
        ]);
        Menu::create([
            'menu' => 'Manajemen Kantor',
            'parent_id' => '2',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-building',
            'order' => 2400
        ]);
        Menu::create([
            'menu' => 'Master Data',
            'parent_id' => '2',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-database',
            'order' => 2500
        ]);
        Menu::create([
            'menu' => "Kantor Saya",
            'parent_id' => '3',
            'has_dropdown' => 0,
            'is_active' => 1,
            'url' => '/admin/kantor-saya',
            'icon' => 'fa-solid fa-building',
            'order' => 3100
        ]);
        Menu::create([
            'menu' => 'Manajemen Paket Wisata',
            'parent_id' => '3',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-box-open',
            'order' => 3200
        ]);
        Menu::create([
            'menu' => "Manajemen Jema'ah",
            'parent_id' => '3',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-person-praying',
            'order' => 3300
        ]);
        Menu::create([
            'menu' => "Manajemen Grup",
            'parent_id' => '3',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-people-group',
            'order' => 3400
        ]);
        Menu::create([
            'menu' => "Pelayanan",
            'parent_id' => '3',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => 'fa-solid fa-handshake-angle',
            'order' => 3500
        ]);
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
