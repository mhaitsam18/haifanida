@props(['name'])

<p x-show="errors['{{ $name }}']" x-text="errors['{{ $name }}'] ? errors['{{ $name }}'][0] : ''" class="-mt-3 mb-3 text-xs text-red-600"></p>
