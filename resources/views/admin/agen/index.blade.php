@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/agen/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari agen...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Nomor Ponsel</th>
                    <th class="px-4 py-3">Kantor</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($agens as $agen)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $agen->user->name }}</td>
                        <td class="px-4 py-3">{{ $agen->user->email }}</td>
                        <td class="px-4 py-3">{{ $agen->user->username }}</td>
                        <td class="px-4 py-3">{{ $agen->user->phone_number }}</td>
                        <td class="px-4 py-3">{{ $agen->kantor->nama_kantor ?? 'Belum diatur' }}</td>
                        <td class="px-4 py-3">
                            @if ($agen->user->photo)
                                <img src="{{ asset('storage/' . $agen->user->photo) }}" alt="Foto" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/agen/{{ $agen->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/agen/' . $agen->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
