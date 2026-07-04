@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/kamar-jemaah" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="kamar_id" class="mb-1.5 block text-sm font-medium text-stone-700">Kamar</label>
                <select id="kamar_id" name="kamar_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Kamar</option>
                    @foreach ($kamars as $item_kamar)
                        <option value="{{ $item_kamar->id }}" @selected($item_kamar->id == old('kamar_id', $kamar->id ?? null))>
                            {{ $item_kamar->nomor_kamar }}</option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jemaah_id" class="mb-1.5 block text-sm font-medium text-stone-700">Jemaah</label>
                <select id="jemaah_id" name="jemaah_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Jemaah</option>
                    @foreach ($jemaahs as $item_jemaah)
                        <option value="{{ $item_jemaah->id }}" @selected($item_jemaah->id == old('jemaah_id', $jemaah->id ?? null))>
                            {{ $item_jemaah->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('jemaah_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                @if ($jemaah)
                    <x-button variant="secondary" :href="'/admin/jemaah/' . $jemaah->id . '/kamar'">Kembali</x-button>
                @elseif($kamar)
                    <x-button variant="secondary" :href="'/admin/kamar/' . $kamar->id">Kembali</x-button>
                @endif
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
