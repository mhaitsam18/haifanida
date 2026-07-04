@props(['title'])

<div class="bg-maroon-900 py-14 text-center text-cream-50">
    <div class="mx-auto max-w-7xl px-4">
        <h1 class="font-display text-3xl font-semibold">{{ $title }}</h1>
        <nav class="mt-3 flex items-center justify-center gap-2 text-sm text-cream-300">
            <a href="/" class="hover:text-cream-100">Beranda</a>
            <i class="bx bx-chevron-right text-xs"></i>
            <span>{{ $title }}</span>
        </nav>
    </div>
</div>
