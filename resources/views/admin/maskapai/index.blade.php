@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/maskapai/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari maskapai...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Nama Maskapai</th>
                    <th class="px-4 py-3">Negara Asal</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Logo</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($maskapais as $maskapai)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $maskapai->kode_maskapai }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $maskapai->nama_maskapai }}</td>
                        <td class="px-4 py-3">{{ $maskapai->negara_asal }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $maskapai->deskripsi }}</td>
                        <td class="px-4 py-3">
                            @if ($maskapai->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($maskapai->logo))
                                <img src="{{ asset('storage/' . $maskapai->logo) }}" alt="{{ $maskapai->nama_maskapai }}" class="h-12 w-12 rounded-lg object-contain">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/maskapai/{{ $maskapai->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/maskapai/' . $maskapai->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
