@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-1/2">
        <form action="/admin/berkas" method="post">
            @csrf
            <x-form-input label="Nama Berkas" name="nama_berkas" :value="old('nama_berkas')" placeholder="Nama Berkas" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="/admin/berkas">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
