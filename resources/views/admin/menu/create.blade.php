@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/menu" method="post">
            @csrf
            <x-form-input label="Menu" name="menu" :value="old('menu')" placeholder="Menu" />

            <div class="mb-4">
                <label for="parent_id" class="mb-1.5 block text-sm font-medium text-stone-700">Parent</label>
                <select id="parent_id" name="parent_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected>Pilih Parent</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" @selected(old('parent_id') == $menu->id)>{{ $menu->order . ' | ' . $menu->menu }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4 flex flex-wrap gap-4">
                <label class="flex items-center gap-2 text-sm text-stone-700">
                    <input type="checkbox" value="1" name="has_dropdown" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('has_dropdown'))>
                    Ada Dropdown?
                </label>
                <label class="flex items-center gap-2 text-sm text-stone-700">
                    <input type="checkbox" value="1" name="is_active" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('is_active'))>
                    Apakah Aktif?
                </label>
            </div>

            <x-form-input label="URL" name="url" :value="old('url')" placeholder="URL" />
            <x-form-input label="Ikon" name="icon" :value="old('icon')" placeholder="Ikon" />
            <x-form-input label="Nomor Urut" name="order" type="number" :value="old('order')" placeholder="Nomor Urut" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="/admin/menu">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
