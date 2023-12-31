<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'author',
            'member',
            'agen',
            'superadmin', //additional
            'adminkantor', //additional
            'jemaah', //additional
            'pusat', //additional
            'cabang', //additional
            'perwakilan', //additional
        ];

        foreach ($roles as $role) {
            Role::create([
                'role' => $role,
            ]);
        }
    }
}
