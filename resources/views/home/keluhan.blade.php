@extends('layouts.app')

@section('content')
    <x-page-banner title="Form Keluhan" />

    <section class="py-20">
        <div class="mx-auto max-w-2xl px-4 text-center">
            <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Kami Mendengarkan</span>
            <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">Form Keluhan</h2>
            <p class="mt-4 text-stone-600">Kami peduli dengan pengalaman Anda. Silakan sampaikan keluhan atau saran melalui formulir kami, dan tim kami akan menanggapi secepat mungkin.</p>
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfJNCjYC6nJ9fwwGd5BBblkM4SITpDo-u_zIBFFQKxCSPmHxQ/viewform?usp=sharing"
                target="_blank" rel="noopener noreferrer"
                class="mt-8 inline-flex items-center gap-2 rounded-full bg-maroon-700 px-6 py-3 text-sm font-semibold text-cream-50 shadow-sm transition hover:bg-maroon-800">
                <i class="bx bx-message-square-detail text-lg"></i> Isi Form Keluhan
            </a>
        </div>
    </section>
@endsection
