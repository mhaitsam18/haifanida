@props(['title', 'subtitle' => null])

{{-- Premium page banner shared by every interior public page. Same `title`
     API as before (subtitle optional), so existing usages need no changes.
     The atmosphere echoes the homepage hero's language: deep maroon dusk,
     a soft gold glow, and the thin Islamic motif divider. --}}
<div class="relative overflow-hidden bg-linear-to-b from-maroon-900 to-maroon-950 py-16 text-center text-cream-50 sm:py-20">
    {{-- Soft gold atmosphere glow, echoing the hero's golden hour --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0"
        style="background: radial-gradient(ellipse 60% 90% at 50% -20%, rgba(230, 192, 120, 0.18) 0%, transparent 65%)"></div>

    <div data-reveal class="relative mx-auto max-w-7xl px-4">
        <h1 class="font-display text-3xl font-semibold sm:text-4xl">{{ $title }}</h1>

        @if ($subtitle)
            <p class="mx-auto mt-3 max-w-2xl text-sm text-cream-200/90 sm:text-base">{{ $subtitle }}</p>
        @endif

        <div aria-hidden="true" class="motif-divider mx-auto mt-5 w-24 text-cream-400"></div>

        <nav class="mt-5 flex items-center justify-center gap-2 text-sm text-cream-300">
            <a href="/" class="transition-colors hover:text-cream-100">Beranda</a>
            <i class="bx bx-chevron-right text-xs text-cream-400"></i>
            <span>{{ $title }}</span>
        </nav>
    </div>
</div>
