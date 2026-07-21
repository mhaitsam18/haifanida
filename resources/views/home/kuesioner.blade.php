@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title"
        subtitle="Kepuasan Anda adalah ukuran keberhasilan kami. Bantu kami menjadi lebih baik." />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4">
            <div data-reveal class="mb-8 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Kuesioner Kepuasan</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900 sm:text-3xl">Bagikan Pengalaman Anda</h2>
                <p class="mx-auto mt-3 max-w-2xl text-stone-600">Isian Anda kami jaga kerahasiaannya dan menjadi masukan berharga untuk meningkatkan mutu pelayanan perjalanan ibadah.</p>
            </div>

            {{-- Embedded Google Form with a graceful loading state: the spinner
                 shows until the iframe fires its load event, so the visitor
                 never stares at a blank white box while the form fetches. --}}
            <div data-reveal x-data="{ loaded: false }" class="relative overflow-hidden rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                <div x-show="!loaded" class="absolute inset-0 z-10 flex flex-col items-center justify-center gap-3 bg-cream-50 text-stone-500">
                    <i class="bx bx-loader-alt animate-spin text-3xl text-maroon-600"></i>
                    <span class="text-sm">Memuat kuesioner...</span>
                </div>
                <iframe
                    src="https://docs.google.com/forms/d/e/1FAIpQLSdhyNI6HqR7KCJZrfZ4pSDYisUMrnNJ7uj4cPlgghP00YR33A/viewform?embedded=true"
                    style="width: 100%; min-height: 800px; border: none;"
                    @load="loaded = true" loading="lazy">Memuat&hellip;</iframe>
            </div>
        </div>
    </section>
@endsection
