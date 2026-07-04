@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        <form action="/admin/jadwal/{{ $jadwal->id }}" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="grup_id" value="{{ $jadwal->grup_id }}">

            <div class="grid gap-x-6 md:grid-cols-2">
                <div>
                    <x-form-input label="Nama Agenda" name="nama_agenda" :value="old('nama_agenda', $jadwal->nama_agenda)" placeholder="Nama Agenda" required />
                    <x-form-input label="Lokasi" name="lokasi" :value="old('lokasi', $jadwal->lokasi)" placeholder="Lokasi" />
                </div>
                <div>
                    <x-form-input label="Waktu Mulai" name="waktu_mulai" type="datetime-local" :value="old('waktu_mulai', $jadwal->waktu_mulai)" />
                    <x-form-input label="Waktu Selesai" name="waktu_selesai" type="datetime-local" :value="old('waktu_selesai', $jadwal->waktu_selesai)" />
                    <x-form-textarea label="Keterangan" name="keterangan" :value="old('keterangan', $jadwal->keterangan)" placeholder="Keterangan" />
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/grup/' . $jadwal->grup_id . '/jadwal'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
