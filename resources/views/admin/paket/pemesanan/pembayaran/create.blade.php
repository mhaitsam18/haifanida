@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/pembayaran" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id ?? null }}">

            <x-form-input label="Jumlah Pembayaran" name="jumlah_pembayaran" type="number" :value="old('jumlah_pembayaran')" placeholder="Jumlah Pembayaran" />
            <x-form-input label="Metode Pembayaran" name="metode_pembayaran" :value="old('metode_pembayaran')" placeholder="(Transfer / QRIS / dll.)" />
            <x-form-input label="Tanggal Pembayaran" name="tanggal_pembayaran" type="date" :value="old('tanggal_pembayaran')" />

            <div class="mb-4">
                <label for="bukti_pembayaran" class="mb-1.5 block text-sm font-medium text-stone-700">Bukti Pembayaran</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                    class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                @error('bukti_pembayaran')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status_pembayaran" class="mb-1.5 block text-sm font-medium text-stone-700">Status Pembayaran</label>
                <select id="status_pembayaran" name="status_pembayaran"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Status</option>
                    <option value="tertunda" @selected('tertunda' == old('status_pembayaran'))>Tertunda</option>
                    <option value="diterima" @selected('diterima' == old('status_pembayaran'))>diterima</option>
                    <option value="ditolak" @selected('ditolak' == old('status_pembayaran'))>ditolak</option>
                </select>
                @error('status_pembayaran')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-textarea label="Keterangan" name="keterangan" :value="old('keterangan')" placeholder="Keterangan" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/' . ($pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '') . 'pembayaran'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
