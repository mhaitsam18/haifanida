@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title">
        <x-slot:actions>
            <x-button href="/admin/menu/create"><i class="bx bx-plus"></i> Tambah</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-data-table searchPlaceholder="Cari menu...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Menu</th>
                    <th class="px-4 py-3">Parent</th>
                    <th class="px-4 py-3">Dropdown</th>
                    <th class="px-4 py-3">Aktif</th>
                    <th class="px-4 py-3">URL</th>
                    <th class="px-4 py-3">Ikon</th>
                    <th class="px-4 py-3">Urutan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($menus as $menu)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $menu->menu }}</td>
                        <td class="px-4 py-3">{{ $menu->parent->menu ?? 'Tidak Ada' }}</td>
                        <td class="px-4 py-3">{{ $menu->has_dropdown ? 'Ada' : 'Tidak Ada' }}</td>
                        <td class="px-4 py-3"><x-badge :variant="$menu->is_active ? 'success' : 'neutral'">{{ $menu->is_active ? 'Aktif' : 'Tidak Aktif' }}</x-badge></td>
                        <td class="px-4 py-3">{{ $menu->url ?? 'Tidak Ada' }}</td>
                        <td class="px-4 py-3">{{ $menu->icon ?? 'Tidak Ada' }}</td>
                        <td class="px-4 py-3">{{ $menu->order }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/admin/menu/{{ $menu->id }}/edit" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</a>
                                @if (!$menu->indelible)
                                    <x-delete-form :action="'/admin/menu/' . $menu->id" />
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
