@props(['title' => null, 'maxWidth' => 'max-w-2xl'])

<div
    x-show="open"
    x-trap.inert.noscroll="open"
    @keydown.escape.window="open && hide()"
    class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto p-4 py-10"
    style="display: none;"
>
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="hide()"
        class="fixed inset-0 bg-maroon-950/50"
    ></div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        {{ $attributes->merge(['class' => 'relative w-full ' . $maxWidth . ' rounded-xl bg-cream-50 p-6 shadow-lg']) }}
    >
        <div class="mb-4 flex items-center justify-between">
            @if ($title)
                <h3 class="font-display text-lg font-semibold text-maroon-900">{{ $title }}</h3>
            @endif
            <button type="button" @click="hide()" class="rounded-full p-1 text-stone-400 hover:bg-cream-200 hover:text-stone-600">
                <i class="bx bx-x text-2xl"></i>
            </button>
        </div>

        {{ $slot }}
    </div>
</div>
