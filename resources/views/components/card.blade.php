@props(['title' => null])

<div {{ $attributes->merge(['class' => 'rounded-xl bg-cream-50 shadow-sm border border-cream-200 p-5']) }}>
    @if ($title)
        <h3 class="mb-3 text-base font-semibold text-maroon-900">{{ $title }}</h3>
    @endif

    {{ $slot }}
</div>
