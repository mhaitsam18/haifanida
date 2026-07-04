@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/konten/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari konten...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Penulis</th>
                    <th class="px-4 py-3">Nama Konten</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kontens as $konten)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $konten->user->name ?? '-' }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $konten->nama }}</td>
                        <td class="px-4 py-3">{{ $konten->judul }}</td>
                        <td class="px-4 py-3">
                            @if ($konten->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($konten->gambar))
                                <img src="{{ asset('storage/' . $konten->gambar) }}" alt="{{ $konten->nama }}" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                @if (!$konten->user_id || auth()->user()->id == $konten->user_id)
                                    <a href="/admin/konten/{{ $konten->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                    @if (!$konten->indelible)
                                        <x-delete-form :action="'/admin/konten/' . $konten->id" />
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
