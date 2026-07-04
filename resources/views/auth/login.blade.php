@extends('layouts.app')

@section('content')
    <section class="py-16">
        <div class="mx-auto grid max-w-5xl gap-10 px-4 lg:grid-cols-2 lg:items-center">
            <div class="hidden overflow-hidden rounded-2xl lg:block">
                <img src="/assets/img/mekkah/aviator70.jpg" alt="Haifa Nida Wisata" class="aspect-3/4 w-full object-cover">
            </div>

            <div class="rounded-2xl border border-cream-200 bg-cream-50 p-8 shadow-sm">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Masuk ke Akun Anda</h2>
                <p class="mt-1 text-sm text-stone-500">Kelola pemesanan umroh dan haji Anda</p>

                @if (session()->has('loginError'))
                    <div class="mt-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('loginError') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="mt-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
                @endif
                @if (session()->has('status'))
                    <div class="mt-4 rounded-lg bg-sky-50 px-4 py-3 text-sm text-sky-700">{{ session('status') }}</div>
                @endif

                <form action="/login" method="post" class="mt-6">
                    @csrf
                    <x-form-input name="email_or_username" placeholder="Username atau Email" :value="old('email_or_username')" required />
                    <x-form-input name="password" type="password" placeholder="Kata Sandi" required />

                    <div class="mb-4 flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-stone-600">
                            <input type="checkbox" name="remember" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('remember'))>
                            Ingat Saya
                        </label>
                        <a href="/forgot-password" class="font-medium text-maroon-700 hover:text-maroon-900">Lupa Kata Sandi?</a>
                    </div>

                    <x-button type="submit" class="w-full justify-center">Log In</x-button>

                    <a href="{{ route('auth.google.login') }}" class="mt-3 flex w-full items-center justify-center gap-2 rounded-lg bg-sky-600 py-2.5 text-sm font-semibold text-white hover:bg-sky-700">
                        <i class="bx bxl-google"></i> Log In dengan Google
                    </a>

                    <p class="mt-5 text-center text-sm text-stone-500">
                        Tidak Punya Akun? <a href="/register" class="font-medium text-maroon-700 hover:text-maroon-900">Daftar Sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
