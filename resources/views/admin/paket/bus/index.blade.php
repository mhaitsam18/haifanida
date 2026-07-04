@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/' . ($paket ? 'paket/' . $paket->id . '/' : '') . 'bus/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            @if ($paket)
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            @endif
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari bus...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">No. Rombongan</th>
                    <th class="px-4 py-3">No. Polisi</th>
                    <th class="px-4 py-3">Merek</th>
                    <th class="px-4 py-3">Kapasitas</th>
                    <th class="px-4 py-3">Fasilitas</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($paket->buses as $bus)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $bus->nomor_rombongan }}</td>
                        <td class="px-4 py-3">{{ $bus->nomor_polisi }}</td>
                        <td class="px-4 py-3">{{ $bus->merek }}</td>
                        <td class="px-4 py-3">{{ $bus->kapasitas }}</td>
                        <td class="px-4 py-3 text-stone-500">{!! $bus->fasilitas !!}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/bus/{{ $bus->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Penumpang</a>
                                <a href="/admin/bus/{{ $bus->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/bus/' . $bus->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
