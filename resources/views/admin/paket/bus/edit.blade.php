@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" :subtitle="$paket->nama_paket ?? null" />

    <x-card class="lg:w-2/3">
        <form action="/admin/bus/{{ $bus->id }}" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="paket_id" value="{{ $bus->paket_id }}">

            <x-form-input label="Nomor Rombongan" name="nomor_rombongan" :value="old('nomor_rombongan', $bus->nomor_rombongan)" placeholder="Nomor Rombongan" />
            <x-form-input label="Nomor Polisi" name="nomor_polisi" :value="old('nomor_polisi', $bus->nomor_polisi)" placeholder="Nomor Polisi" />
            <x-form-input label="Merek / PO" name="merek" :value="old('merek', $bus->merek)" placeholder="Merek / PO" />
            <x-form-input label="Kapasitas" name="kapasitas" type="number" :value="old('kapasitas', $bus->kapasitas)" placeholder="Kapasitas" />
            <x-form-textarea label="Fasilitas" name="fasilitas" :value="old('fasilitas', $bus->fasilitas)" placeholder="Fasilitas" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/paket/' . $bus->paket_id . '/bus'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
