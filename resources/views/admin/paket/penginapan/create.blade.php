@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        <form action="/admin/penginapan" method="post">
            @csrf
            <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">

            <div class="grid gap-x-6 md:grid-cols-2">
                <div>
                    <div class="mb-4">
                        <label for="hotel_id" class="mb-1.5 block text-sm font-medium text-stone-700">Hotel</label>
                        <select id="hotel_id" name="hotel_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Hotel</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}" @selected($hotel->id == old('hotel_id'))>{{ $hotel->nama_hotel }}</option>
                            @endforeach
                        </select>
                        @error('hotel_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-form-input label="Nomor Reservasi" name="nomor_reservasi" :value="old('nomor_reservasi')" placeholder="Nomor Reservasi" />
                    <x-form-input label="Tanggal Check In" name="tanggal_check_in" type="date" :value="old('tanggal_check_in')" />
                    <x-form-input label="Tanggal Check Out" name="tanggal_check_out" type="date" :value="old('tanggal_check_out')" />
                </div>
                <div>
                    <x-form-input label="Jumlah Kamar" name="jumlah_kamar" type="number" :value="old('jumlah_kamar')" placeholder="Jumlah Kamar" />
                    <x-form-input label="Total Harga" name="total_harga" type="number" :value="old('total_harga')" placeholder="Total Harga" />
                    <x-form-textarea label="Keterangan Hotel" name="keterangan_hotel" :value="old('keterangan_hotel')" placeholder="Keterangan Hotel" />
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id . '/penginapan'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
