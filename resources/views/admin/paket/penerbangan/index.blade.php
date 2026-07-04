@extends('admin.layouts.app')

@section('content')
    @php use Carbon\Carbon; @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/paket/' . $paket->id . '/penerbangan/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari penerbangan...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Maskapai</th>
                    <th class="px-4 py-3">No. Penerbangan</th>
                    <th class="px-4 py-3">PNR</th>
                    <th class="px-4 py-3">Kelas</th>
                    <th class="px-4 py-3">Kuota</th>
                    <th class="px-4 py-3">Harga Tiket</th>
                    <th class="px-4 py-3">Asal</th>
                    <th class="px-4 py-3">Tujuan</th>
                    <th class="px-4 py-3">Berangkat</th>
                    <th class="px-4 py-3">Tiba</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Gate</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($penerbangans as $penerbangan)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $penerbangan->maskapai->nama_maskapai }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->nomor_penerbangan }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->nomor_pnr }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->kelas }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->kuota }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($penerbangan->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->bandara_asal }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->bandara_tujuan }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penerbangan->waktu_keberangkatan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($penerbangan->waktu_kedatangan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->status_penerbangan }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->tipe_penerbangan }}</td>
                        <td class="px-4 py-3">{{ $penerbangan->gate_penerbangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/penerbangan/{{ $penerbangan->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/penerbangan/' . $penerbangan->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
