@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/' . ($paket ? 'paket/' . $paket->id . '/' : '') . 'grup/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            @if ($paket)
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari grup...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Agen</th>
                    <th class="px-4 py-3">Nama Grup</th>
                    <th class="px-4 py-3">Ketua Grup</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Kuota</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($grups as $grup)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $grup->agen->user->name ?? null }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $grup->nama_grup }}</td>
                        <td class="px-4 py-3">{{ $grup->ketua_grup }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $grup->keterangan_grup }}</td>
                        <td class="px-4 py-3">{{ $grup->kuota_grup }}</td>
                        <td class="px-4 py-3">{{ $grup->status_grup }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/grup/{{ $grup->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <a href="/admin/grup/{{ $grup->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/grup/' . $grup->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
