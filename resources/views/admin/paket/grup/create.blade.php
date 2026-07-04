@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        @if ($paket)
            <h4 class="font-display mb-4 text-base font-semibold text-maroon-900">{{ $paket->nama_paket }}</h4>
        @endif
        <form action="/admin/grup" method="post">
            @csrf
            <input type="hidden" name="paket_id" value="{{ $paket->id ?? old('paket_id') }}">

            <div class="grid gap-x-6 md:grid-cols-2">
                <div>
                    @if (!$paket)
                        <div class="mb-4">
                            <label for="paket_id" class="mb-1.5 block text-sm font-medium text-stone-700">Paket <span class="text-maroon-700">*</span></label>
                            <select id="paket_id" name="paket_id"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Paket</option>
                                @foreach ($pakets as $item)
                                    <option value="{{ $item->id }}" @selected($item->id == old('paket_id'))>{{ $item->nama_paket }}</option>
                                @endforeach
                            </select>
                            @error('paket_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    <div class="mb-4">
                        <label for="agen_id" class="mb-1.5 block text-sm font-medium text-stone-700">Agen</label>
                        <select id="agen_id" name="agen_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="">Pilih Agen</option>
                            @foreach ($agens as $agen)
                                <option value="{{ $agen->id }}" @selected($agen->id == old('agen_id'))>{{ $agen->user->name }}</option>
                            @endforeach
                        </select>
                        @error('agen_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-form-input label="Nama Grup" name="nama_grup" :value="old('nama_grup')" placeholder="Nama Grup" required />
                    <x-form-input label="Ketua Grup" name="ketua_grup" :value="old('ketua_grup')" placeholder="Ketua Grup" />
                </div>
                <div>
                    <x-form-input label="Status Grup" name="status_grup" :value="old('status_grup')" placeholder="Status Grup" />
                    <x-form-input label="Kuota Grup" name="kuota_grup" type="number" :value="old('kuota_grup')" placeholder="Kuota Grup" />
                    <x-form-textarea label="Keterangan Grup" name="keterangan_grup" :value="old('keterangan_grup')" placeholder="Keterangan Grup" />
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/' . ($paket ? 'paket/' . $paket->id . '/' : '') . 'grup'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
