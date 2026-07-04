@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/hotel/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari hotel...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Nama Hotel</th>
                    <th class="px-4 py-3">Bintang</th>
                    <th class="px-4 py-3">Kota</th>
                    <th class="px-4 py-3">Negara</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($hotels as $hotel)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $hotel->kode_hotel }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $hotel->nama_hotel }}</td>
                        <td class="px-4 py-3 text-amber-500">
                            @for ($i = 0; $i < $hotel->bintang; $i++)
                                <i class="bx bxs-star"></i>
                            @endfor
                        </td>
                        <td class="px-4 py-3">{{ $hotel->kota }}</td>
                        <td class="px-4 py-3">{{ $hotel->negara }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $hotel->alamat }}</td>
                        <td class="px-4 py-3">
                            @if ($hotel->gambar)
                                <img src="{{ asset('storage/' . $hotel->gambar) }}" alt="{{ $hotel->nama_hotel }}" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/hotel/{{ $hotel->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/hotel/' . $hotel->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
