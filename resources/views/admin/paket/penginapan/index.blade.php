@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/paket/' . $paket->id . '/penginapan/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari penginapan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Hotel</th>
                    <th class="px-4 py-3">No. Reservasi</th>
                    <th class="px-4 py-3">Check In</th>
                    <th class="px-4 py-3">Check Out</th>
                    <th class="px-4 py-3">Jumlah Kamar</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($paket->penginapans as $penginapan)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $penginapan->hotel->nama_hotel }}</td>
                        <td class="px-4 py-3">{{ $penginapan->nomor_reservasi }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penginapan->tanggal_check_in)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penginapan->tanggal_check_out)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $penginapan->jumlah_kamar }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($penginapan->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $penginapan->keterangan_hotel }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/penginapan/{{ $penginapan->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Kamar</a>
                                <a href="/admin/penginapan/{{ $penginapan->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/penginapan/' . $penginapan->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
