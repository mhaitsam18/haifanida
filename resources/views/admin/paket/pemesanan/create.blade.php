@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        <form action="/admin/pemesanan" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">
            <h4 class="font-display mb-4 text-base font-semibold text-maroon-900">{{ $paket->nama_paket ?? null }}</h4>

            <div class="grid gap-x-6 md:grid-cols-2">
                <div>
                    <div class="mb-4">
                        <label for="user_id" class="mb-1.5 block text-sm font-medium text-stone-700">Pemesan</label>
                        <select id="user_id" name="user_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="">Pilih Pemesan</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected($user->id == old('user_id'))>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="status" class="mb-1.5 block text-sm font-medium text-stone-700">Status</label>
                        <select id="status" name="status"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Tertunda" @selected('Tertunda' == old('status'))>Tertunda</option>
                            <option value="dikonfirmasi" @selected('dikonfirmasi' == old('status'))>dikonfirmasi</option>
                            <option value="diterima" @selected('diterima' == old('status'))>diterima</option>
                            <option value="ditolak" @selected('ditolak' == old('status'))>ditolak</option>
                            <option value="dibatalkan" @selected('dibatalkan' == old('status'))>dibatalkan</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-form-input label="Tanggal Pemesanan" name="tanggal_pesan" type="date" :value="old('tanggal_pesan')" />
                    <x-form-input label="Jumlah Jema'ah / Wisatawan" name="jumlah_orang" type="number" :value="old('jumlah_orang')" placeholder="Jumlah Jema'ah / Wisatawan" />
                </div>
                <div>
                    <x-form-input label="Total Harga" name="total_harga" type="number" :value="old('total_harga')" placeholder="Total Harga" />
                    <x-form-input label="Metode Pembayaran" name="metode_pembayaran" :value="old('metode_pembayaran', 'Cash')" placeholder="(Cash/Tunai/Cicilan/Tabungan/Hutang/Umroh dulu baru bayar)" />
                    <div class="mb-4">
                        <label class="flex items-center gap-2 text-sm text-stone-700">
                            <input type="checkbox" value="1" name="is_pembayaran_lunas" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('is_pembayaran_lunas'))>
                            Sudah Lunas?
                        </label>
                        @error('is_pembayaran_lunas')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-form-input label="Tanggal Pelunasan" name="tanggal_pelunasan" type="date" :value="old('tanggal_pelunasan')" />
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/' . ($paket ? 'paket/' . $paket->id . '/' : '') . 'pemesanan'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
