@props(['label' => null, 'name', 'required' => false])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-stone-700">
            {{ $label }} @if ($required)<span class="text-maroon-700">*</span>@endif
        </label>
    @endif
    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full rounded-lg border px-3 py-2 text-sm text-stone-800 focus:outline-none focus:ring-2 ' . ($errors->has($name) ? 'border-red-400 focus:ring-red-200' : 'border-cream-300 focus:border-maroon-400 focus:ring-maroon-100')]) }}>
        {{ $slot }}
    </select>
    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
