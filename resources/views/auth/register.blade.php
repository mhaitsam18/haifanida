@extends('layouts.app')

@section('content')
    @php
        $googleData = session('google_data');
    @endphp

    <section class="py-16">
        <div class="mx-auto grid max-w-5xl gap-10 px-4 lg:grid-cols-2 lg:items-center">
            <div class="hidden overflow-hidden rounded-2xl lg:block">
                <img src="/assets/img/mekkah/aviator70.jpg" alt="Haifa Nida Wisata" class="aspect-3/4 w-full object-cover">
            </div>

            <div class="rounded-2xl border border-cream-200 bg-cream-50 p-8 shadow-sm">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Daftar Akun Baru</h2>
                <p class="mt-1 text-sm text-stone-500">Mulai perjalanan ibadah Anda bersama kami</p>

                @if (session()->has('loginError'))
                    <div class="mt-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('loginError') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="mt-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
                @endif
                @if (session()->has('status'))
                    <div class="mt-4 rounded-lg bg-sky-50 px-4 py-3 text-sm text-sky-700">{{ session('status') }}</div>
                @endif
                @if (session()->has('info'))
                    <div class="mt-4 rounded-lg bg-sky-50 px-4 py-3 text-sm text-sky-700">{{ session('info') }}</div>
                @endif

                <form action="/register" method="post" class="mt-6">
                    @csrf
                    @if ($googleData)
                        <input type="hidden" name="google_id" value="{{ $googleData['google_id'] }}">
                        <input type="hidden" name="google_token" value="{{ $googleData['google_token'] }}">
                        <input type="hidden" name="avatar" value="{{ $googleData['avatar'] }}">
                    @endif

                    <x-form-input label="Nama Lengkap" name="name" placeholder="Nama Lengkap" :value="$googleData['name'] ?? old('name')" required @if ($googleData) readonly @endif />
                    <div>
                        <x-form-input label="Username" name="username" placeholder="Username" :value="old('username')" required />
                        <p id="username-availability" class="-mt-3 mb-3 text-xs"></p>
                    </div>
                    <div>
                        <x-form-input label="Email" name="email" type="email" placeholder="Email" :value="$googleData['email'] ?? old('email')" required @if ($googleData) readonly @endif />
                        <p id="email-availability" class="-mt-3 mb-3 text-xs"></p>
                    </div>
                    <x-form-input label="Nomor Ponsel" name="phone_number" placeholder="Nomor Ponsel" :value="old('phone_number')" required />
                    <x-form-input label="Kata Sandi" name="password" type="password" placeholder="Kata Sandi" required />
                    <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" required />
                    <x-form-input label="Kode Referral (opsional)" name="kode_referral" placeholder="Kode Referral Agen" :value="old('kode_referral', request()->query('ref'))" />

                    <x-button type="submit" class="w-full justify-center">Daftar</x-button>

                    <a href="{{ route('auth.google.register') }}" class="mt-3 flex w-full items-center justify-center gap-2 rounded-lg bg-sky-600 py-2.5 text-sm font-semibold text-white hover:bg-sky-700">
                        <i class="bx bxl-google"></i> Daftar dengan Google
                    </a>

                    <p class="mt-5 text-center text-sm text-stone-500">
                        Sudah Punya Akun? <a href="/login" class="font-medium text-maroon-700 hover:text-maroon-900">Log In Sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function checkAvailability(inputId, resultId, urlPrefix, label) {
                const input = document.getElementById(inputId);
                input.addEventListener('input', function () {
                    if (!this.value) {
                        document.getElementById(resultId).textContent = '';
                        return;
                    }
                    fetch(urlPrefix + '/' + encodeURIComponent(this.value), {
                        headers: { 'Accept': 'application/json' },
                    })
                        .then(response => response.json())
                        .then(data => {
                            const available = data.status === 'available';
                            const el = document.getElementById(resultId);
                            el.textContent = available ? label + ' tersedia' : label + ' sudah digunakan';
                            el.style.color = available ? '#15803d' : '#dc2626';
                        })
                        .catch(error => console.error('Error:', error));
                });
            }

            checkAvailability('username', 'username-availability', '/check-username', 'Username');
            checkAvailability('email', 'email-availability', '/check-email', 'Email');
        });
    </script>
@endsection
