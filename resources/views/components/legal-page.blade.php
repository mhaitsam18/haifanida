@props(['title', 'subtitle' => null, 'sections' => []])

{{-- Shared layout for long legal documents (syarat-ketentuan,
     kebijakan-privasi): a sticky table-of-contents with scroll-spy on the
     left, the document body on the right. The TOC is real wayfinding for
     dense text, not decoration. On mobile the TOC collapses into a simple
     jump menu above the content. Scroll-spy lives in home-experience.js
     (initLegalToc), keyed on [data-legal-toc]. --}}
<x-page-banner :title="$title" :subtitle="$subtitle" />

<section class="py-12 sm:py-16">
    <div class="mx-auto max-w-6xl px-4">
        <div class="lg:grid lg:grid-cols-4 lg:gap-10">
            {{-- Table of contents --}}
            @if (count($sections))
                <aside class="mb-8 lg:col-span-1 lg:mb-0">
                    <nav data-legal-toc class="lg:sticky lg:top-24 rounded-2xl border border-cream-200 bg-cream-50 p-5">
                        <h2 class="mb-3 text-xs font-semibold uppercase tracking-widest text-maroon-700">Daftar Isi</h2>
                        <ul class="space-y-1 text-sm">
                            @foreach ($sections as $section)
                                <li>
                                    <a href="#{{ $section['id'] }}" data-toc-link="{{ $section['id'] }}"
                                        class="block rounded-md border-l-2 border-transparent py-1.5 pl-3 text-stone-600 transition-colors hover:text-maroon-700">
                                        {{ $section['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </aside>
            @endif

            <div class="lg:col-span-3">
                <div class="prose max-w-none prose-headings:font-display prose-headings:text-maroon-800 prose-p:text-stone-600 prose-strong:text-maroon-800 prose-a:text-maroon-700">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</section>
