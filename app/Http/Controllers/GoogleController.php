<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordEmail;
use Illuminate\Support\Facades\Mail;

class GoogleController extends Controller
{

    // MODIFIED: Menambahkan parameter untuk membedakan login dan register
    public function redirectToGoogle(Request $request)
    {
        session(['auth_type' => $request->type]); // Simpan tipe auth (login/register) di session
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->getId())->first();
            $checkemail = User::where('email', $user->getEmail())->first();
            $auth_type = session('auth_type', 'login');

            // MODIFIED: Jika mencoba login
            if ($auth_type === 'login') {
                if ($finduser || $checkemail) {
                    $login = $finduser ?: $checkemail;
                    // Update Google data jika belum ada
                    if (!$login->google_id) {
                        $login->update([
                            'google_id' => $user->getId(),
                            'avatar' => $user->getAvatar(),
                            'google_token' => $user->token,
                        ]);
                    }
                } else {
                    // Jika login tapi belum punya akun, suruh daftar dulu
                    return redirect('/register')->with('loginError', 'Akun belum terdaftar. Silakan daftar terlebih dahulu.');
                }
            } 
            // MODIFIED: Jika mencoba register, langsung buat akun
            else {
                if ($finduser || $checkemail) {
                    return redirect('/login')->with('loginError', 'Email sudah terdaftar. Silakan login.');
                }

                // Generate username dari email
                $username = strtolower(explode('@', $user->getEmail())[0]);
                $baseUsername = $username;
                $counter = 1;
                
                while (User::where('username', $username)->exists()) {
                    $username = $baseUsername . $counter;
                    $counter++;
                }

                // Buat user baru
                $login = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'username' => $username,
                    'google_id' => $user->getId(),
                    'avatar' => $user->getAvatar(),
                    'google_token' => $user->token,
                    'role_id' => 3,
                    'email_verified_at' => now(),
                    'password' => Hash::make($user->getId() . uniqid()), // Generate random password
                ]);

                // Buat member profile
                Member::create([
                    'user_id' => $login->id,
                    'nama_lengkap' => $user->getName(),
                    'email' => $user->getEmail(),
                ]);
            }

            // MODIFIED: Proses login
            Auth::login($login);
            
            // MODIFIED: Simpan data member ke session
            if ($login->role_id === 3) {
                $member = Member::where('user_id', $login->id)->first();
                session()->put('member', $member);
                session()->put('member_id', $member->id);
            }

            // MODIFIED: Redirect ke home controller
            return redirect()->route('index')->with('success', $auth_type === 'register' ? 'Registrasi berhasil!' : 'Login berhasil!');

        } catch (\Throwable $th) {
            return redirect('/login')->with('loginError', 'Terjadi kesalahan selama autentikasi Google. Silakan coba lagi.');
        }
    }
}
