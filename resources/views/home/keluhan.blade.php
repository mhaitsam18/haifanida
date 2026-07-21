@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title ?? 'Pengaduan & Keluhan'"
        subtitle="Setiap masukan Anda kami perlakukan dengan serius dan penuh tanggung jawab." />

    <section class="py-16 sm:py-24">
        <div class="mx-auto max-w-2xl px-4">
            <div data-reveal class="overflow-hidden rounded-3xl border border-cream-200 bg-cream-50 p-8 text-center shadow-sm sm:p-12">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-maroon-100 text-3xl text-maroon-700">
                    <i class="bx bx-message-square-detail"></i>
                </div>
                <span class="mt-6 block text-sm font-semibold uppercase tracking-widest text-maroon-700">Kami Mendengarkan</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900">Sampaikan Keluhan atau Saran Anda</h2>
                <p class="mx-auto mt-4 max-w-md text-stone-600">Kami peduli dengan pengalaman Anda. Silakan sampaikan keluhan atau saran melalui formulir kami, dan tim kami akan menanggapi secepat mungkin.</p>

                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfJNCjYC6nJ9fwwGd5BBblkM4SITpDo-u_zIBFFQKxCSPmHxQ/viewform?usp=sharing"
                    target="_blank" rel="noopener noreferrer"
                    class="mt-8 inline-flex items-center gap-2 rounded-full bg-maroon-700 px-6 py-3 text-sm font-semibold text-cream-50 shadow-sm transition hover:-translate-y-0.5 hover:bg-maroon-800 hover:shadow-md">
                    <i class="bx bx-message-square-detail text-lg"></i> Isi Form Keluhan
                    <i class="bx bx-link-external"></i>
                </a>

                <div class="mt-8 flex items-center justify-center gap-2 border-t border-cream-200 pt-6 text-sm text-stone-500">
                    <i class="bx bxl-whatsapp text-lg text-maroon-600"></i>
                    <span>Butuh bantuan cepat?</span>
                    <a href="https://wa.me/6282299198002" target="_blank" class="font-semibold text-maroon-700 hover:text-maroon-900">Chat WhatsApp</a>
                </div>
            </div>
        </div>
    </section>
@endsection
