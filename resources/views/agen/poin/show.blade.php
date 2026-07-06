@extends('agen.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-xl font-bold text-maroon-900">Detail Poin</h1>
        <a href="{{ route('agen.poin.index') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    <x-card class="max-w-lg">
        <ul class="space-y-2 text-sm text-stone-700">
            <li><span class="text-stone-500">Tanggal:</span> {{ Carbon::parse($poin->created_at)->isoFormat('LLLL') }}</li>
            <li><span class="text-stone-500">Tipe:</span> <x-badge variant="brand">{{ $poin->tipe }}</x-badge></li>
            <li><span class="text-stone-500">Jumlah Poin:</span>
                <span class="font-semibold {{ $poin->jumlah_poin >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                    {{ $poin->jumlah_poin >= 0 ? '+' : '' }}{{ $poin->jumlah_poin }}
                </span>
            </li>
            <li><span class="text-stone-500">Keterangan:</span> {{ $poin->keterangan ?? '-' }}</li>
        </ul>
    </x-card>
@endsection
