@props(['variant' => 'primary', 'href' => null, 'type' => 'button'])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary' => 'bg-maroon-700 text-cream-50 hover:bg-maroon-800 focus:outline-none focus:ring-2 focus:ring-maroon-300',
        'secondary' => 'bg-cream-200 text-maroon-800 hover:bg-cream-300 focus:outline-none focus:ring-2 focus:ring-cream-400',
        'outline' => 'border border-maroon-700 text-maroon-700 hover:bg-maroon-50 focus:outline-none focus:ring-2 focus:ring-maroon-300',
        'danger' => 'bg-red-700 text-white hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-300',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
