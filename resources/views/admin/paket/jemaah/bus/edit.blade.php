@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/bus-jemaah/{{ $busJemaah->id }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $busJemaah->id }}">

            <div class="mb-4">
                <label for="bus_id" class="mb-1.5 block text-sm font-medium text-stone-700">Bus</label>
                <select id="bus_id" name="bus_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Bus</option>
                    @foreach ($buses as $item_bus)
                        <option value="{{ $item_bus->id }}" @selected($item_bus->id == old('bus_id', $busJemaah->bus_id))>
                            {{ $item_bus->nomor_rombongan }}</option>
                    @endforeach
                </select>
                @error('bus_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jemaah_id" class="mb-1.5 block text-sm font-medium text-stone-700">Jemaah</label>
                <select id="jemaah_id" name="jemaah_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Jemaah</option>
                    @foreach ($jemaahs as $item_jemaah)
                        <option value="{{ $item_jemaah->id }}" @selected($item_jemaah->id == old('jemaah_id', $busJemaah->jemaah_id))>
                            {{ $item_jemaah->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('jemaah_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Nomor Kursi" name="nomor_kursi" :value="old('nomor_kursi', $busJemaah->nomor_kursi)" placeholder="Nomor Kursi" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="javascript:history.back()">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
