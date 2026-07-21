@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title"
        subtitle="Jawaban atas pertanyaan yang paling sering diajukan jema'ah kami." />

    <section class="py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4">
            <div data-reveal class="mb-10 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-maroon-700">Pusat Bantuan</span>
                <h2 class="font-display mt-2 text-2xl font-semibold text-maroon-900 sm:text-3xl">Frequently Asked Questions</h2>
                <p class="mx-auto mt-3 max-w-2xl text-stone-600">Kami selalu memprioritaskan pertanyaan Anda secara gratis dan Anda dapat dengan mudah mengajukan pertanyaan kapan saja.</p>
            </div>

            @forelse ($faqGroups as $kategori => $faqs)
                <div data-reveal class="mb-10">
                    @if (count($faqGroups) > 1 || $kategori !== 'Umum')
                        <h3 class="font-display mb-4 flex items-center gap-3 text-lg font-semibold text-maroon-800">
                            {{ $kategori }}
                            <span aria-hidden="true" class="motif-divider w-16 flex-none text-cream-500"></span>
                        </h3>
                    @endif
                    <div class="space-y-3">
                        @foreach ($faqs as $faq)
                            <x-accordion-item :question="$faq->pertanyaan">
                                {{ $faq->jawaban }}
                            </x-accordion-item>
                        @endforeach
                    </div>
                </div>
            @empty
                {{-- Premium empty state — visible only if the admin deactivates every FAQ --}}
                <div data-reveal class="rounded-2xl border border-cream-200 bg-cream-50 px-6 py-16 text-center">
                    <i class="bx bx-help-circle text-5xl text-maroon-300"></i>
                    <h3 class="font-display mt-4 text-xl font-semibold text-maroon-900">Belum ada FAQ untuk saat ini</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm text-stone-600">Silakan hubungi kami langsung — tim kami siap menjawab pertanyaan Anda.</p>
                    <x-button href="/kontak-kami" variant="primary" class="mt-6">Hubungi Kami <i class="bx bx-chevron-right"></i></x-button>
                </div>
            @endforelse

            <div data-reveal class="mt-12 rounded-2xl bg-maroon-900 px-6 py-8 text-center text-cream-50 sm:px-10">
                <h3 class="font-display text-xl font-semibold">Masih ada pertanyaan?</h3>
                <p class="mx-auto mt-2 max-w-md text-sm text-cream-200/90">Tim kami siap membantu Anda merencanakan perjalanan ibadah dengan tenang.</p>
                <div class="mt-5 flex flex-wrap items-center justify-center gap-3">
                    <x-button href="/kontak-kami" variant="primary">Kontak Kami <i class="bx bx-chevron-right"></i></x-button>
                    <x-button href="https://wa.me/6282299198002" target="_blank" variant="outline"
                        class="border-cream-200! text-cream-100! hover:bg-cream-50/10!"><i class="bx bxl-whatsapp"></i> WhatsApp</x-button>
                </div>
            </div>
        </div>
    </section>
@endsection
