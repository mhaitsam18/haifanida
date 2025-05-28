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
    public function loginAdmin()
    {
        return view('admin.auth.index', [
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
            'title' => 'Registrasi'
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'username' => 'required|unique:users',
            'phone_number' => 'nullable',
            'password' => 'required|confirmed',
            'google_id' => 'nullable',
            'google_token' => 'nullable',
            'avatar' => 'nullable',
        ]);

        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 3,
        ];

        // MODIFIED: Tambahkan data Google jika ada
        if ($request->has('google_id')) {
            $userData['google_id'] = $validatedData['google_id'];
            $userData['google_token'] = $validatedData['google_token'];
            $userData['avatar'] = $validatedData['avatar'];
            $userData['email_verified_at'] = now();
        }

        $user = User::create($userData);

        Member::create([
            'user_id' => $user->id,
            'nama_lengkap' => $validatedData['name'],
            'email' => $validatedData['email'],
            'nomor_telepon' => $validatedData['phone_number'],
        ]);

        if (!$request->has('google_id')) {
            $verificationLink = $this->generateVerificationLink($user);
            Mail::to($user->email)->send(new VerificationEmail($verificationLink));
            return redirect('/login')->with('success', 'Email verifikasi telah dikirim. Silakan cek email Anda!');
        }

        // MODIFIED: Login dan redirect ke home controller untuk mendapatkan data yang diperlukan
        Auth::login($user);
        session()->put('member', Member::where('user_id', $user->id)->first());
        session()->put('member_id', $user->id);
        
        return redirect()->route('index')->with('success', 'Registrasi berhasil!');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email_or_username' => ['required'],
            'password' => ['required'],
        ]);

        $isEmail = filter_var($credentials['email_or_username'], FILTER_VALIDATE_EMAIL);
        $user = $isEmail
            ? User::where('email', $credentials['email_or_username'])->first()
            : User::where('username', $credentials['email_or_username'])->first();

        // MODIFIED: Jika user belum terdaftar, arahkan ke halaman registrasi
        if (!$user) {
            return redirect('/register')->with('loginError', 'Akun belum terdaftar. Silakan registrasi terlebih dahulu.');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return back()->with('loginError', 'Email Anda belum diverifikasi, Silahkan cek Email Anda');
        }

        $loginCredentials = [
            'password' => $request->input('password')
        ];
        
        if ($isEmail) {
            $loginCredentials['email'] = $credentials['email_or_username'];
        } else {
            $loginCredentials['username'] = $credentials['email_or_username'];
        }

        $remember = $request->has('remember');

        if (Auth::attempt($loginCredentials, $remember)) {
            $request->session()->regenerate();
            
            // MODIFIED: Simpan data member ke session jika role member
            if (auth()->user()->role_id === 3) {
                $member = Member::where('user_id', auth()->user()->id)->first();
                $request->session()->put('member', $member);
                $request->session()->put('member_id', $member->id);
            }

            // MODIFIED: Redirect ke home controller untuk mendapatkan data yang diperlukan
            return redirect()->route('index')->with('success', 'Login berhasil!');
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
