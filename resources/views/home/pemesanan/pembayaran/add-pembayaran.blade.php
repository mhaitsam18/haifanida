@extends('layouts.app')

@section('content')
    <section class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif

            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Tambah Pembayaran</h2>
                <p class="mt-1 text-sm text-stone-500">Silakan isi informasi pembayaran dengan benar</p>
            </div>

            <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                <x-card>
                    <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                        <i class="bx bx-credit-card"></i> Data Pembayaran
                    </h3>

                    <x-form-input label="Jumlah Pembayaran" name="jumlah_pembayaran" type="number" required placeholder="Masukkan jumlah pembayaran" />

                    <div class="mb-4">
                        <label for="metode_pembayaran" class="mb-1.5 block text-sm font-medium text-stone-700">Metode Pembayaran <span class="text-maroon-700">*</span></label>
                        <select id="metode_pembayaran" name="metode_pembayaran" required
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Metode Pembayaran</option>
                            <option value="QRIS" @selected(old('metode_pembayaran') == 'QRIS')>QRIS</option>
                            <option value="Transfer Bank" @selected(old('metode_pembayaran') == 'Transfer Bank')>Transfer Bank</option>
                            <option value="Cash" @selected(old('metode_pembayaran') == 'Cash')>Cash / Tunai</option>
                        </select>
                        @error('metode_pembayaran')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-input label="Tanggal Pembayaran" name="tanggal_pembayaran" type="date" required />

                    <div class="mb-4">
                        <label for="bukti_pembayaran" class="mb-1.5 block text-sm font-medium text-stone-700">Bukti Pembayaran <span class="text-maroon-700">*</span></label>
                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required
                            class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                        @error('bukti_pembayaran')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-textarea label="Keterangan / Catatan" name="keterangan" :rows="3" placeholder="Masukkan keterangan atau catatan tambahan (opsional)" />

                    <div class="grid gap-8 border-t border-cream-200 pt-6 md:grid-cols-2">
                        <div>
                            <h3 class="font-display mb-2 text-base font-semibold text-maroon-900">Informasi No. Rekening</h3>
                            <div class="space-y-2 text-sm text-stone-600">
                                <p><span class="font-medium text-stone-800">Bank Mandiri</span><br>1320014831409 a/n Haifa Nida Wisata Karawang</p>
                                <p><span class="font-medium text-stone-800">Bank BCA</span><br>1092826656 a/n Haifa Nida Wisata Karawang</p>
                                <p><span class="font-medium text-stone-800">Bank BJB</span><br>0000410697000 a/n Haifa nida wisata karawang, PT</p>
                                <p><span class="font-medium text-stone-800">Bank CIMB Niaga</span><br>860018161900 a/n Haifa Nida Wisata Karawang</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-display mb-2 text-base font-semibold text-maroon-900">Informasi QRIS</h3>
                            <img class="mx-auto mb-2 w-1/2" src="{{ asset('assets/img/logos/Logo_QRIS.svg.png') }}" alt="QRIS">
                            <p class="text-sm font-medium text-stone-800">HAIFA NIDA WISATA</p>
                            <p class="text-xs text-stone-500">NMID: ID1024345420797</p>
                            <img class="mx-auto mt-2 w-1/2" src="{{ asset('assets/img/logos/haifa_nida_wisata_qris_regenerated.png') }}" alt="QRIS Code">
                        </div>
                    </div>
                </x-card>

                <div class="mt-6 flex items-center justify-between">
                    <x-button variant="secondary" :href="route('pemesanan.detail', $pemesanan->id)">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                    <x-button type="submit">
                        <i class="bx bx-save"></i> Simpan Data
                    </x-button>
                </div>
            </form>
        </div>
    </section>
@endsection
