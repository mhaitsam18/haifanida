@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-1/2">
        <form action="/admin/penumpang" method="post">
            @csrf
            <input type="hidden" name="bus_id" value="{{ $bus->id ?? null }}">

            <div class="mb-4">
                <label for="jemaah_id" class="mb-1.5 block text-sm font-medium text-stone-700">Jemaah</label>
                <select id="jemaah_id" name="jemaah_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih jemaah</option>
                    @foreach ($jemaahs as $jemaah)
                        <option value="{{ $jemaah->id }}" @selected(old('jemaah_id') == $jemaah->id)>{{ $jemaah->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('jemaah_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Nomor Kursi" name="nomor_kursi" type="number" :value="old('nomor_kursi')" placeholder="Nomor Kursi" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/' . ($bus ? 'bus/' . $bus->id . '/' : '') . 'penumpang'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
