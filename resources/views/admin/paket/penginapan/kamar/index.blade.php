@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/penginapan/' . $penginapan->id . '/kamar/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <x-button variant="secondary" :href="'/admin/paket/' . $penginapan->paket_id . '/penginapan'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari kamar...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nomor Kamar</th>
                    <th class="px-4 py-3">Tipe Kamar</th>
                    <th class="px-4 py-3">Kapasitas</th>
                    <th class="px-4 py-3">Fasilitas</th>
                    <th class="px-4 py-3">Ketersediaan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kamars as $kamar)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $kamar->nomor_kamar }}</td>
                        <td class="px-4 py-3">{{ $kamar->tipe_kamar }}</td>
                        <td class="px-4 py-3">{{ $kamar->kapasitas }}</td>
                        <td class="px-4 py-3">{{ $kamar->fasilitas }}</td>
                        <td class="px-4 py-3"><x-badge :variant="$kamar->tersedia == 1 ? 'success' : 'danger'">{{ $kamar->tersedia == 1 ? 'Tersedia' : 'Tidak Tersedia' }}</x-badge></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/kamar/{{ $kamar->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Tamu</a>
                                <a href="/admin/kamar/{{ $kamar->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/kamar/' . $kamar->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
