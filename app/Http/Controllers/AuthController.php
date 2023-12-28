<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Member;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use App\Mail\VerificationEmail;
use App\Mail\ForgotPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
            // return redirect('/home');
        } else if (auth()->user()->role_id == 1) {
            return redirect('/admin/index');
        } else if (auth()->user()->role_id == 2) {
            return redirect('/author/index');
        } else if (auth()->user()->role_id == 3) {
            return redirect('/member/index');
        } else if (auth()->user()->role_id == 4) {
            return redirect('/agen/index');
        } else {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/');
        }
    }

    public function login()
    {
        return view('auth.login', [
            'title' => 'login'
        ]);
    }

    public function checkUsernameAvailability($username)
    {
        $isAvailable = User::where('username', $username)->count() === 0;

        return response()->json(['status' => $isAvailable ? 'available' : 'used']);
    }

    public function checkEmailAvailability($email)
    {
        $isAvailable = User::where('email', $email)->count() === 0;

        return response()->json(['status' => $isAvailable ? 'available' : 'used']);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Registrasi',
            'data_provinsi' => Provinsi::all(),
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        // if ($request->file('foto')) {
        //     $validatedData['foto'] = $request->file('foto')->store('foto-profil');
        // };

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 3,
            // 'foto' => $validatedData['foto'],
        ]);

        Member::create([
            'user_id' => $user->id,
            'nama_lengkap' => $validatedData['name'],
            'email' => $validatedData['email'],
            // 'foto' => $validatedData['foto'],
        ]);
        $verificationLink = $this->generateVerificationLink($user);

        Mail::to($user->email)->send(new VerificationEmail($verificationLink));
        return redirect('/login')->with('success', 'Email verifikasi telah dikirim. Silakan cek email Anda!');
    }


    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email_or_username' => ['required'], // Ubah 'email' menjadi 'email_or_username'
            'password' => ['required'],
        ]);

        // Periksa apakah 'email_or_username' adalah alamat email
        $isEmail = filter_var($credentials['email_or_username'], FILTER_VALIDATE_EMAIL);

        // Jika itu adalah alamat email, cari user berdasarkan email, jika tidak cari berdasarkan username
        $user = $isEmail
            ? User::where('email', $credentials['email_or_username'])->first()
            : User::where('username', $credentials['email_or_username'])->first();

        if (!$user) {
            return back()->with('loginError', 'Email atau Username atau Password Salah');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return back()->with('loginError', 'Email Anda belum diverifikasi, Silahkan cek Email Anda');
        }
        // if ($user && !$user->email_verified_at && $user->role_id == 3) {
        //     return back()->with('loginError', 'Email Anda belum diverifikasi, Silahkan cek Email Anda');
        // }

        $credential['password'] = $request->input('password');
        if ($user->email) {
            $credential['email'] = $user->email;
        } elseif ($user->username) {
            $credential['username'] = $user->username;
        } else {
            return back()->with('loginError', 'Email atau Username atau Password Salah');
        }


        $remember = $request->has('remember');
        if (Auth::attempt($credential, $remember)) {
            $request->session()->regenerate();
            switch (auth()->user()->role_id) {
                case 1:
                    return redirect()->intended('/admin/index');
                    break;
                case 2:
                    return redirect()->intended('/author/index');
                    break;
                case 4:
                    return redirect()->intended('/agen/index');
                    break;
                case 3:
                    $member = Member::where('user_id', auth()->user()->id)->first();
                    $request->session()->put('member', $member);
                    $request->session()->put('member_id', $member->id);
                    return redirect()->intended('/member/index');
                    break;
                default:
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return back()->with('loginError', 'Akun Anda tidak memiliki otoritas apapun, Hubungi Admin terkait');
                    break;
            }
        }
        return back()->with('loginError', 'Email atau Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password', [
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

            // return redirect('/login')->with('status', 'Kami telah mengirimkan link reset kata sandi ke email Anda.');
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
        // $request->validate(['token' => 'required']);

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

    /**
     * Mengirim email verifikasi ke user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendVerificationEmail(Request $request)
    {
        $email = $request->input('email'); // Ambil alamat email dari request

        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->email_verified_at === null) {
                $user->sendEmailVerificationNotification();

                // $verificationLink = $this->generateVerificationLink($user);

                // Mail::to($user->email)->send(new VerificationEmail($verificationLink));

                return response()->json(['message' => 'Email verifikasi telah dikirim. Silakan cek email Anda.'], 200);
            } else {
                return response()->json(['message' => 'Email Anda sudah terverifikasi.'], 400);
            }
        } else {
            return response()->json(['message' => 'User dengan email tersebut tidak ditemukan.'], 404);
        }
    }

    /**
     * Generate link verifikasi untuk user.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return string
     */
    private function generateVerificationLink($user)
    {
        $expires = now()->addMinutes(config('auth.verification.expire', 60));
        $hash = sha1($user->getEmailForVerification());

        return URL::temporarySignedRoute(
            'verification.verify',
            $expires,
            ['id' => $user->id, 'hash' => $hash]
        );
    }

    public function verifyEmail(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404, 'User not found.');
        }
        // dd(sha1($user->getEmailForVerification()));
        // dd($request->route('hash'));
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/login')->with('status', 'Email ini sudah diverifikasi'); // Atau URL tujuan setelah verifikasi
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/login')->with('success', 'Email berhasil diverifikasi');
    }

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
