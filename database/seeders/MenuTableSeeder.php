<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::craete([
            'menu' => 'Akun Saya',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-user"></i>',
            'order' => 1.
        ]);
        Menu::craete([
            'menu' => 'Autentikasi & Otorisasi',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-face-smile"></i>',
            'order' => 2.
        ]);
        Menu::craete([
            'menu' => 'Manajemen Pengguna',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-users"></i>',
            'order' => 3.
        ]);
        Menu::craete([
            'menu' => 'Manajemen Aplikasi',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-regular fa-window-restore"></i>',
            'order' => 4.
        ]);
        Menu::craete([
            'menu' => 'Manajemen Kantor',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-building"></i>',
            'order' => 5.
        ]);
        Menu::craete([
            'menu' => 'Master Data',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-database"></i>',
            'order' => 6.
        ]);
        Menu::craete([
            'menu' => 'Manajemen Paket Wisata',
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-database"></i>',
            'order' => 7.
        ]);
        Menu::craete([
            'menu' => "Manajemen Jema'ah",
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-database"></i>',
            'order' => 8.
        ]);
        Menu::craete([
            'menu' => "Manajemen Grup",
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-database"></i>',
            'order' => 9.
        ]);
        Menu::craete([
            'menu' => "Pelayanan",
            'has_dropdown' => 1,
            'is_active' => 1,
            'url' => '#',
            'icon' => '<i class="fa-solid fa-database"></i>',
            'order' => 10.
        ]);
    }
}
