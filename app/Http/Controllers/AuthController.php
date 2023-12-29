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
}
