@props(['title', 'subtitle' => null])

<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-xl font-bold text-maroon-900">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-0.5 text-sm text-stone-500">{{ $subtitle }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
