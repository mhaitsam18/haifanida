@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="flex min-h-96 items-center justify-center py-20">
        <div class="mx-auto max-w-lg px-4 text-center">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-maroon-100 text-maroon-700">
                <i class="bx bx-time-five text-4xl"></i>
            </div>
            <h1 class="font-display mt-6 text-3xl font-semibold text-maroon-900">Segera Hadir</h1>
            <p class="mt-4 text-stone-600">Kami sedang mempersiapkan paket tour terbaik untuk perjalanan Anda. Tunggu kabar terbaru dari kami!</p>
            <a href="/" class="mt-8 inline-flex items-center gap-2 rounded-full bg-maroon-700 px-6 py-3 text-sm font-semibold text-cream-50 shadow-sm transition hover:bg-maroon-800">
                Kembali ke Beranda <i class="bx bx-chevron-right"></i>
            </a>
        </div>
    </section>
@endsection
