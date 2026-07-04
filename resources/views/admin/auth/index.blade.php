@extends('admin.auth.layouts.app')

@section('content')
    <div class="w-full max-w-md rounded-2xl border border-cream-200 bg-cream-50 p-8 shadow-xl">
        <div class="mb-6 text-center">
            <img src="/assets/img/logos/logo-full.png" alt="Haifa Nida" class="mx-auto h-14">
            <h2 class="font-display mt-4 text-xl font-semibold text-maroon-900">Haifa Nida <span class="text-maroon-500">Admin</span></h2>
            <p class="mt-1 text-sm text-stone-500">Selamat Datang di Halaman Admin! Silahkan Log In.</p>
        </div>

        @if (session()->has('loginError'))
            <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('loginError') }}</div>
        @endif
        @if (session()->has('success'))
            <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
        @endif
        @if (session()->has('status'))
            <div class="mb-4 rounded-lg bg-sky-50 px-4 py-3 text-sm text-sky-700">{{ session('status') }}</div>
        @endif

        <form action="/login" method="post">
            @csrf
            <input type="hidden" name="role" value="admin">
            <x-form-input label="Email atau Username" name="email_or_username" :value="old('email_or_username')" placeholder="Email atau Username" required />
            <x-form-input label="Kata Sandi" name="password" type="password" placeholder="Kata Sandi" required />

            <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                <input type="checkbox" name="remember" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('remember'))>
                Ingat Saya
            </label>

            <x-button type="submit" class="w-full justify-center">Login</x-button>

            <a href="{{ url('/auth/google') }}" class="mt-3 flex w-full items-center justify-center gap-2 rounded-lg bg-sky-600 py-2.5 text-sm font-semibold text-white hover:bg-sky-700">
                <i class="bx bxl-google"></i> Login dengan Google
            </a>

            <div class="mt-5 flex flex-col items-center gap-1.5 text-sm">
                <a href="/admin/forgot-password" class="text-maroon-700 hover:text-maroon-900">Lupa Kata Sandi?</a>
                <a href="/" class="text-stone-500 hover:text-stone-700">Halaman Web</a>
            </div>
        </form>
    </div>
@endsection
