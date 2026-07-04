@extends('layouts.app')

@section('content')
    <section class="py-16">
        <div class="mx-auto grid max-w-5xl gap-10 px-4 lg:grid-cols-2 lg:items-center">
            <div class="hidden overflow-hidden rounded-2xl lg:block">
                <img src="/assets/img/mekkah/aviator70.jpg" alt="Haifa Nida Wisata" class="aspect-3/4 w-full object-cover">
            </div>

            <div class="rounded-2xl border border-cream-200 bg-cream-50 p-8 shadow-sm">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Lupa Kata Sandi</h2>
                <p class="mt-1 text-sm text-stone-500">Kami akan mengirim anda link ke Email Anda</p>

                @if (session()->has('loginError'))
                    <div class="mt-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('loginError') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="mt-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
                @endif
                @if (session()->has('status'))
                    <div class="mt-4 rounded-lg bg-sky-50 px-4 py-3 text-sm text-sky-700">{{ session('status') }}</div>
                @endif

                <form action="/forgot-password" method="post" class="mt-6">
                    @csrf
                    <x-form-input name="email" placeholder="Email" :value="old('email')" required />
                    <x-button type="submit" class="w-full justify-center">Kirim</x-button>
                    <p class="mt-5 text-center text-sm text-stone-500">
                        Kembali ke halaman <a href="/login" class="font-medium text-maroon-700 hover:text-maroon-900">Log In</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
