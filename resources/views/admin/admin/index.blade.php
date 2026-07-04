@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/user-admin/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari admin...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Nomor Ponsel</th>
                    <th class="px-4 py-3">SuperAdmin?</th>
                    <th class="px-4 py-3">Kantor</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($admins as $admin)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $admin->user->name }}</td>
                        <td class="px-4 py-3">{{ $admin->user->email }}</td>
                        <td class="px-4 py-3">{{ $admin->user->username }}</td>
                        <td class="px-4 py-3">{{ $admin->user->phone_number }}</td>
                        <td class="px-4 py-3">
                            @if ($admin->is_superadmin)
                                <x-badge variant="success"><i class="bx bx-check"></i></x-badge>
                            @else
                                <x-badge variant="danger"><i class="bx bx-x"></i></x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $admin->kantor->nama_kantor ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if ($admin->user->photo)
                                <img src="{{ asset('storage/' . $admin->user->photo) }}" alt="Foto" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/user-admin/{{ $admin->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                <x-delete-form :action="'/admin/user-admin/' . $admin->id" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
