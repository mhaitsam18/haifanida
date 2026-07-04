@props(['variant' => 'neutral'])

@php
    $variants = [
        'success' => 'bg-emerald-100 text-emerald-800',
        'danger' => 'bg-red-100 text-red-800',
        'warning' => 'bg-amber-100 text-amber-800',
        'info' => 'bg-sky-100 text-sky-800',
        'neutral' => 'bg-stone-100 text-stone-700',
        'brand' => 'bg-maroon-100 text-maroon-800',
    ];

    $classes = 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ' . ($variants[$variant] ?? $variants['neutral']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
