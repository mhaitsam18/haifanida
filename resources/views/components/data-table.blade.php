@props(['searchPlaceholder' => 'Cari...'])

<div x-data="{ q: '' }" {{ $attributes->merge(['class' => 'rounded-xl border border-cream-200 bg-cream-50 shadow-sm']) }}>
    <div class="flex items-center justify-between gap-3 border-b border-cream-200 p-4">
        <div class="relative w-full max-w-xs">
            <i class="bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"></i>
            <input type="text" x-model="q" placeholder="{{ $searchPlaceholder }}"
                class="w-full rounded-lg border border-cream-300 py-2 pl-9 pr-3 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
        </div>
        @isset($actions)
            <div class="flex items-center gap-2">{{ $actions }}</div>
        @endisset
    </div>

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>
