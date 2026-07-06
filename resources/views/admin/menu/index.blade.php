@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Menu">
            <form action="/admin/menu" method="post" @submit="submit">
                @csrf
                <x-form-input label="Menu" name="menu" placeholder="Menu" />
                <x-form-error name="menu" />

                <div class="mb-4">
                    <label for="parent_id" class="mb-1.5 block text-sm font-medium text-stone-700">Parent</label>
                    <select id="parent_id" name="parent_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected>Pilih Parent</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->order . ' | ' . $menu->menu }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="parent_id" />
                </div>

                <div class="mb-4 flex flex-wrap gap-4">
                    <label class="flex items-center gap-2 text-sm text-stone-700">
                        <input type="checkbox" value="1" name="has_dropdown" class="rounded text-maroon-700 focus:ring-maroon-400">
                        Ada Dropdown?
                    </label>
                    <label class="flex items-center gap-2 text-sm text-stone-700">
                        <input type="checkbox" value="1" name="is_active" class="rounded text-maroon-700 focus:ring-maroon-400">
                        Apakah Aktif?
                    </label>
                </div>
                <x-form-error name="has_dropdown" />
                <x-form-error name="is_active" />

                <x-form-input label="URL" name="url" placeholder="URL" />
                <x-form-error name="url" />

                <x-form-input label="Ikon" name="icon" placeholder="Ikon" />
                <x-form-error name="icon" />

                <x-form-input label="Nomor Urut" name="order" type="number" placeholder="Nomor Urut" />
                <x-form-error name="order" />

                <div class="flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div>

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
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                @if (!$menu->indelible)
                                    <x-delete-form :action="'/admin/menu/' . $menu->id" />
                                @endif

                                <x-modal title="Edit Menu">
                                    <form action="/admin/menu/{{ $menu->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <x-form-input label="Menu" name="menu" :value="$menu->menu" placeholder="Menu" />
                                        <x-form-error name="menu" />

                                        <div class="mb-4">
                                            <label for="parent_id_{{ $menu->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Parent</label>
                                            <select id="parent_id_{{ $menu->id }}" name="parent_id"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected>Pilih Parent</option>
                                                @foreach ($menus as $parent)
                                                    <option value="{{ $parent->id }}" @selected($menu->parent_id == $parent->id)>{{ $parent->order . ' | ' . $parent->menu }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="parent_id" />
                                        </div>

                                        <div class="mb-4 flex flex-wrap gap-4">
                                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                                <input type="checkbox" value="1" name="has_dropdown" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($menu->has_dropdown)>
                                                Ada Dropdown?
                                            </label>
                                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                                <input type="checkbox" value="1" name="is_active" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($menu->is_active)>
                                                Apakah Aktif?
                                            </label>
                                        </div>
                                        <x-form-error name="has_dropdown" />
                                        <x-form-error name="is_active" />

                                        <x-form-input label="URL" name="url" :value="$menu->url" placeholder="URL" />
                                        <x-form-error name="url" />

                                        <x-form-input label="Ikon" name="icon" :value="$menu->icon" placeholder="Ikon" />
                                        <x-form-error name="icon" />

                                        <x-form-input label="Nomor Urut" name="order" type="number" :value="$menu->order" placeholder="Nomor Urut" />
                                        <x-form-error name="order" />

                                        <div class="flex justify-end gap-2">
                                            <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                                            <x-button type="submit">
                                                <span x-show="!submitting">Simpan</span>
                                                <span x-show="submitting">Menyimpan...</span>
                                            </x-button>
                                        </div>
                                    </form>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
