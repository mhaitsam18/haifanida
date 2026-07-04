@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button variant="secondary" href="javascript:history.back()"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card class="lg:w-2/3">
        <ul class="space-y-1.5 text-sm text-stone-700">
            <li><span class="text-stone-500">Nama Jema'ah:</span> {{ $bus->jemaah->nama_lengkap }}</li>
            <li><span class="text-stone-500">Nomor Kursi:</span> {{ $bus->nomor_kursi }}</li>
            <li><span class="text-stone-500">Nomor Rombongan:</span> {{ $bus->bus->nomor_rombongan }}</li>
        </ul>
    </x-card>
@endsection
