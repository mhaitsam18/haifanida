<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password', [
            'title' => 'Lupa Kata Sandi'
        ]);
    }

    public function admin()
    {
        return view('admin.auth.forgot-password', [
            'title' => 'Lupa Kata Sandi'
        ]);
    }

    public function sendForgotPasswordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)
            ->first();

        if ($user) {
            // $resetLink = $this->generatePasswordResetLink($user);
            // Mail::to($user->email)->send(new ForgotPasswordEmail($resetLink));

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? redirect('/login')->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        } else {
            return back()->withErrors(['email' => 'User dengan email atau username tersebut tidak ditemukan.']);
        }
    }

    private function generatePasswordResetLink($user)
    {
        $temporarySignedURL = URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(config('auth.passwords.users.expire', 60)),
            [
                'token' => app('auth.password.broker')->createToken($user),
                'email' => $user->email,
            ]
        );

        return $temporarySignedURL;
    }

    public function showResetForm(Request $request, string $token, string $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors(['token' => 'Link reset password tidak valid.']);
        }
        return view('auth.reset-password', [
            'title' => 'Atur Ulang Kata Sandi',
            'user' => $user,
            'token' => $token,
            'email' => $email,
        ]);
    }

    function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
