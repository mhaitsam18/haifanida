@props(['question'])

<div x-data="{ open: false }" class="overflow-hidden rounded-lg border border-cream-200 bg-cream-50">
    <button type="button" @click="open = !open" class="flex w-full items-center justify-between gap-3 px-5 py-4 text-left font-semibold text-maroon-900">
        <span>{{ $question }}</span>
        <i class="bx bx-plus shrink-0 transition" :class="open && 'rotate-45'"></i>
    </button>
    <div x-show="open" x-collapse x-cloak class="border-t border-cream-200 px-5 py-4 text-sm leading-relaxed text-stone-600">
        {{ $slot }}
    </div>
</div>
