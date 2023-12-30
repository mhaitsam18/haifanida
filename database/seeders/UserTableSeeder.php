<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agen;
use App\Models\Author;
use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@haifanida.com',
            'username' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'photo' => 'user-photo/administrator.png',
            'role_id' => Role::where('role', 'admin')->first()->id,
        ]);
        User::create([
            'name' => 'Haitsam',
            'email' => 'haitsam03@gmail.com',
            'username' => 'haitsam',
            'email_verified_at' => now(),
            'google_id' => '113982475180921431021',
            'google_token' => 'ya29.a0AfB_byDUt-piBnkg82ZwvgmfTzUMSTioC6rBX-Dd4F4vokCprL06tXZkFEARAN_JRrSSVe7EB8j_3GVyRCzJrjq7VfuIe3SHhcp7ENIQ48x3ASsDPyJeURmbj8aqsyMcfs4RT2ipFwVJncanBSyPKJser8kHPZcJgZijaCgYKATYSARASFQHGX2Mi9_AfUUxXAHgAGWYPH2glYg0171',
            'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocLiEOS4CVAtLdSqyBys53Or930-Efoh48Y2-Oxn-zplBRQ=s96-c',
            'password' => Hash::make('1234'),
            'photo' => 'user-photo/haitsam.jpg',
            'role_id' => Role::where('role', 'member')->first()->id,
        ]);

        $users = User::all();
        foreach ($users as $user) {
            switch ($user->role_id) {
                case 1:
                    Admin::create(
                        [
                            'user_id' => $user->id,
                            'is_superadmin' => ($user->id == 1) ? 1 : 0
                        ]
                    );
                    break;
                case 2:
                    Author::create(
                        [
                            'user_id' => $user->id,
                        ]
                    );
                    break;
                case 3:
                    Member::create(
                        [
                            'user_id' => $user->id,
                        ]
                    );
                    break;
                case 4:
                    Agen::create(
                        [
                            'user_id' => $user->id,
                        ]
                    );
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
}
