<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->getId())->first();
            $checkemail = User::where('email', $user->getEmail())->first();

            if ($finduser) {
                $login = $finduser;
            } elseif ($checkemail) {
                $checkemail->update([
                    'google_id' => $user->getId()
                ]);
                $login = $checkemail;
            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'username' => $user->getNickname(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'avatar' => $user->getAvatar(),
                    'google_token' => $user->token,
                    'role_id' => 3,
                ]);

                Member::create([
                    'user_id' => $newUser->id,
                    'nama_lengkap' => $user->getName(),
                    'email' => $user->getEmail(),
                ]);

                // Send email verification notification
                $newUser->sendEmailVerificationNotification();
                $login = $newUser;
            }
        } catch (\Throwable $th) {
            return redirect('/login')->with('loginError', 'Terjadi kesalahan selama autentikasi Google. Silakan coba lagi.');
        }
        if ($login) {
            session()->regenerate();
            Auth::login($login);

            // Check and update email verification status
            if (!$login->hasVerifiedEmail()) {
                $login->sendEmailVerificationNotification();
            }
            switch ($login->role_id) {
                case 1:
                    return redirect()->intended('/admin/index');
                    break;
                case 2:
                    return redirect()->intended('/author/index');
                    break;
                case 3:
                    return redirect()->intended('/member/index');
                    break;
                case 4:
                    return redirect()->intended('/agen/index');
                    break;
                default:
                    Auth::logout();
                    session()->invalidate();
                    session()->regenerateToken();
                    return redirect('/login')->with('loginError', 'Akun Anda tidak memiliki otoritas apapun, Hubungi Admin terkait');
                    break;
            }
        } else {
            return redirect('/home');
        }
    }

    private function processLogin(User $user)
    {
        session()->regenerate();
        Auth::login($user);

        // Check and update email verification status
        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
        switch ($user->role_id) {
            case 1:
                return redirect()->intended('/admin/index');
                break;
            case 2:
                return redirect()->intended('/author/index');
                break;
            case 3:
                return redirect()->intended('/member/index');
                break;
            case 4:
                return redirect()->intended('/agen/index');
                break;
            default:
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();
                return redirect('/login')->with('loginError', 'Akun Anda tidak memiliki otoritas apapun, Hubungi Admin terkait');
                break;
        }
    }
}
