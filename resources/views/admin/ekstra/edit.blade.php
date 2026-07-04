@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/ekstra/{{ $ekstra->id }}" method="post">
            @method('put')
            @csrf
            <x-form-input label="Nama Ekstra" name="nama_ekstra" :value="old('nama_ekstra', $ekstra->nama_ekstra)" placeholder="Nama Ekstra" />
            <x-form-input label="Harga Default / Harga Bawaan" name="harga_default" :value="old('harga_default', $ekstra->harga_default)" placeholder="Harga Default / Harga Bawaan" />

            <div class="mb-4">
                <label for="jenis_ekstra" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Ekstra</label>
                <select id="jenis_ekstra" name="jenis_ekstra"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="">Jenis Ekstra</option>
                    <option value="perlengkapan" @selected(old('jenis_ekstra', $ekstra->jenis_ekstra) == 'perlengkapan')>Perlengkapan</option>
                    <option value="jasa" @selected(old('jenis_ekstra', $ekstra->jenis_ekstra) == 'jasa')>Jasa</option>
                    <option value="permintaan kamar" @selected(old('jenis_ekstra', $ekstra->jenis_ekstra) == 'permintaan kamar')>Permintaan Kamar</option>
                    <option value="tipe kamar" @selected(old('jenis_ekstra', $ekstra->jenis_ekstra) == 'tipe kamar')>Tipe Kamar</option>
                    <option value="pesawat" @selected(old('jenis_ekstra', $ekstra->jenis_ekstra) == 'pesawat')>Pesawat</option>
                </select>
                @error('jenis_ekstra')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-textarea label="Deskripsi" name="deskripsi" :value="old('deskripsi', $ekstra->deskripsi)" placeholder="Deskripsi" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="/admin/ekstra">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
