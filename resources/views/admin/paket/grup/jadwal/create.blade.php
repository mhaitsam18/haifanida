@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        <form action="/admin/jadwal" method="post">
            @csrf
            <input type="hidden" name="grup_id" value="{{ $grup->id ?? old('grup_id') }}">

            <div class="grid gap-x-6 md:grid-cols-2">
                <div>
                    @if (!$grup)
                        <div class="mb-4">
                            <label for="grup_id" class="mb-1.5 block text-sm font-medium text-stone-700">Grup <span class="text-maroon-700">*</span></label>
                            <select id="grup_id" name="grup_id"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Grup</option>
                                @foreach ($grups as $item)
                                    <option value="{{ $item->id }}" @selected($item->id == old('grup_id'))>{{ $item->nama_grup }}</option>
                                @endforeach
                            </select>
                            @error('grup_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    <x-form-input label="Nama Agenda" name="nama_agenda" :value="old('nama_agenda')" placeholder="Nama Agenda" required />
                    <x-form-input label="Lokasi" name="lokasi" :value="old('lokasi')" placeholder="Lokasi" />
                </div>
                <div>
                    <x-form-input label="Waktu Mulai" name="waktu_mulai" type="datetime-local" :value="old('waktu_mulai')" />
                    <x-form-input label="Waktu Selesai" name="waktu_selesai" type="datetime-local" :value="old('waktu_selesai')" />
                    <x-form-textarea label="Keterangan" name="keterangan" :value="old('keterangan')" placeholder="Keterangan" />
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="$grup ? '/admin/grup/' . $grup->id . '/jadwal' : '/admin/jadwal'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
