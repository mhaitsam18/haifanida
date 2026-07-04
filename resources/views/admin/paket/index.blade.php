@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/paket/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari paket...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Paket</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Durasi</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Keberangkatan</th>
                    <th class="px-4 py-3">Kepulangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pakets as $paket)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $paket->nama_paket }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $paket->jenis_paket }}</x-badge></td>
                        <td class="px-4 py-3">{{ $paket->durasi }} Hari</td>
                        <td class="px-4 py-3">Rp.{{ number_format($paket->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ Carbon\Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon\Carbon::parse($paket->tanggal_selesai)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/paket/{{ $paket->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <a href="/admin/paket/{{ $paket->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/paket/' . $paket->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
