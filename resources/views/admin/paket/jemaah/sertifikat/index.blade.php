@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button :href="'/admin/jemaah/' . $jemaah->id . '/sertifikat/create'"><i class="bx bx-plus"></i> Tambah</x-button>
            <x-button variant="secondary" :href="'/admin/jemaah/' . $jemaah->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari sertifikat...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nomor Sertifikat</th>
                    <th class="px-4 py-3">Tanggal Penerbitan</th>
                    <th class="px-4 py-3">Tanggal Kadaluarsa</th>
                    <th class="px-4 py-3">Jenis Sertifikat</th>
                    <th class="px-4 py-3">Sertifikat</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($sertifikatJemaahs as $sertifikat)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $sertifikat->nomor_sertifikat }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($sertifikat->tanggal_penerbitan)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon::parse($sertifikat->tanggal_kadaluarsa)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ $sertifikat->jenis_sertifikat }}</td>
                        <td class="px-4 py-3"><img src="{{ asset('storage/' . $sertifikat->sertifikat) }}" alt="" class="h-14 w-20 rounded object-cover"></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/sertifikat-jemaah/{{ $sertifikat->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/sertifikat-jemaah/' . $sertifikat->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
