@extends('admin.auth.layouts.app')

@section('content')
    <div class="w-full max-w-md rounded-2xl border border-cream-200 bg-cream-50 p-8 shadow-xl">
        <div class="mb-6 text-center">
            <h2 class="font-display text-xl font-semibold text-maroon-900">Haifa Nida <span class="text-maroon-500">Admin</span></h2>
            <p class="mt-1 text-sm text-stone-500">Kami akan mengirim link atur ulang kata sandi ke email Anda.</p>
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

        <form action="/forgot-password" method="post">
            @csrf
            <input type="hidden" name="role" value="admin">
            <x-form-input label="Email" name="email" type="email" :value="old('email')" placeholder="Email" required />
            <x-button type="submit" class="w-full justify-center">Kirim</x-button>
            <a href="/login-admin" class="mt-4 block text-center text-sm text-stone-500 hover:text-stone-700">Kembali ke Halaman Log in?</a>
        </form>
    </div>
@endsection
