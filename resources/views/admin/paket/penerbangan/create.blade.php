@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        <form action="/admin/penerbangan" method="post">
            @csrf
            <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">

            <div class="grid gap-x-6 md:grid-cols-2">
                <div>
                    <div class="mb-4">
                        <label for="maskapai_id" class="mb-1.5 block text-sm font-medium text-stone-700">Maskapai</label>
                        <select id="maskapai_id" name="maskapai_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Maskapai</option>
                            @foreach ($maskapais as $maskapai)
                                <option value="{{ $maskapai->id }}" @selected($maskapai->id == old('maskapai_id'))>{{ $maskapai->nama_maskapai }}</option>
                            @endforeach
                        </select>
                        @error('maskapai_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-form-input label="Nomor Penerbangan" name="nomor_penerbangan" :value="old('nomor_penerbangan')" placeholder="Nomor Penerbangan" />
                    <x-form-input label="PNR" name="nomor_pnr" :value="old('nomor_pnr')" placeholder="PNR" />
                    <x-form-input label="Kelas" name="kelas" :value="old('kelas')" placeholder="Kelas" />
                    <x-form-input label="Kuota" name="kuota" type="number" :value="old('kuota')" placeholder="Kuota" />
                    <x-form-textarea label="Keterangan Penerbangan" name="keterangan_penerbangan" :value="old('keterangan_penerbangan')" placeholder="Keterangan Penerbangan" />
                    <x-form-input label="Total Harga" name="total_harga" type="number" :value="old('total_harga')" placeholder="Total Harga" />
                </div>
                <div>
                    <x-form-input label="Bandara Asal" name="bandara_asal" :value="old('bandara_asal')" placeholder="Bandara Asal" />
                    <x-form-input label="Bandara Tujuan" name="bandara_tujuan" :value="old('bandara_tujuan')" placeholder="Bandara Tujuan" />
                    <x-form-input label="Waktu Keberangkatan" name="waktu_keberangkatan" type="datetime-local" :value="old('waktu_keberangkatan')" />
                    <x-form-input label="Waktu Kedatangan" name="waktu_kedatangan" type="datetime-local" :value="old('waktu_kedatangan')" />

                    <div class="mb-4">
                        <label for="status_penerbangan" class="mb-1.5 block text-sm font-medium text-stone-700">Status Penerbangan</label>
                        <select id="status_penerbangan" name="status_penerbangan"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Status Penerbangan</option>
                            @foreach (['On Schedule', 'Delay', 'Canceled', 'Emergency Landing', 'Failed', 'Landed Safely', 'Accident', 'Crash'] as $status)
                                <option value="{{ $status }}" @selected(old('status_penerbangan') == $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('status_penerbangan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tipe_penerbangan" class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Penerbangan</label>
                        <select id="tipe_penerbangan" name="tipe_penerbangan"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Tipe Penerbangan</option>
                            <option value="Langsung" @selected(old('tipe_penerbangan') == 'Langsung')>Langsung / Direct</option>
                            <option value="Transit" @selected(old('tipe_penerbangan') == 'Transit')>Transit / Connecting</option>
                        </select>
                        @error('tipe_penerbangan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-input label="Gate Penerbangan" name="gate_penerbangan" :value="old('gate_penerbangan')" placeholder="Gate Penerbangan" />
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id . '/penerbangan'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
