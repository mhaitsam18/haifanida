@props(['question'])

{{--
    Refined FAQ accordion. The open/close animation uses CSS
    grid-template-rows (0fr → 1fr) instead of Alpine's x-collapse, which
    animated pixel height on every frame and caused visible layout thrash.
    grid-rows transitions are far smoother and need no JS measurement.
    Without JS the panel renders open (content stays accessible); Alpine
    only adds the collapse behavior. aria-expanded/-controls + a labelled
    region make it screen-reader friendly.
--}}
<div x-data="{ open: false }" x-id="['faq-panel']"
    class="overflow-hidden rounded-xl border border-cream-200 bg-cream-50 shadow-sm transition-shadow duration-300 hover:shadow-md">
    <h3>
        <button type="button" @click="open = !open"
            :aria-expanded="open ? 'true' : 'false'" :aria-controls="$id('faq-panel')"
            class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left font-semibold text-maroon-900 transition-colors hover:text-maroon-700">
            <span>{{ $question }}</span>
            <span class="grid h-6 w-6 shrink-0 place-items-center rounded-full bg-maroon-100 text-maroon-700 transition-transform duration-300 ease-out motion-reduce:transition-none"
                :class="open && 'rotate-45'" aria-hidden="true">
                <i class="bx bx-plus text-lg"></i>
            </span>
        </button>
    </h3>
    <div :id="$id('faq-panel')" role="region"
        class="grid transition-[grid-template-rows] duration-300 ease-out motion-reduce:transition-none"
        :class="open ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
        <div class="overflow-hidden">
            <div class="border-t border-cream-200 px-5 pb-5 pt-4 text-sm leading-relaxed text-stone-600">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
