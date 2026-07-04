@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/kamar" method="post">
            @csrf
            <input type="hidden" name="paket_hotel_id" value="{{ $paketHotel->id ?? null }}">

            <x-form-input label="Nomor Kamar" name="nomor_kamar" :value="old('nomor_kamar')" placeholder="Nomor Kamar" />

            <div class="mb-4">
                <label for="tipe_kamar" class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                <select id="tipe_kamar" name="tipe_kamar"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Tipe Kamar</option>
                    @foreach (['Single', 'Double', 'Triple', 'Quad', 'Suite', 'Lainnya'] as $tipe)
                        <option value="{{ $tipe }}" @selected($tipe == old('tipe_kamar'))>{{ $tipe }}</option>
                    @endforeach
                </select>
                @error('tipe_kamar')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Kapasitas" name="kapasitas" type="number" :value="old('kapasitas')" placeholder="Kapasitas" />
            <x-form-textarea label="Fasilitas" name="fasilitas" :value="old('fasilitas')" placeholder="Fasilitas" />

            <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                <input type="checkbox" value="1" name="tersedia" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('tersedia'))>
                Tersedia?
            </label>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/penginapan/' . $paketHotel->id . '/kamar'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
