@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            @if ($grup)
                <x-button :href="'/admin/grup/' . $grup->id . '/jadwal/create'"><i class="bx bx-plus"></i> Tambah</x-button>
                <x-button variant="secondary" :href="'/admin/grup/' . $grup->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari jadwal...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Agenda</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Waktu Mulai</th>
                    <th class="px-4 py-3">Waktu Selesai</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($jadwals as $jadwal)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $jadwal->nama_agenda }}</td>
                        <td class="px-4 py-3">{{ $jadwal->lokasi }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($jadwal->waktu_mulai)->isoFormat('LLL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($jadwal->waktu_selesai)->isoFormat('LLL') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $jadwal->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/jadwal/{{ $jadwal->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/jadwal/' . $jadwal->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
