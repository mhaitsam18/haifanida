@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                @if ($paket)
                    <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Data Paket Ekstra">
            <form action="/admin/paket-ekstra" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">

                <div class="mb-4">
                    <label for="ekstra_id" class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra</label>
                    <select id="ekstra_id" name="ekstra_id" x-ref="harga"
                        @change="$refs.harga_input.value = $event.target.options[$event.target.selectedIndex].dataset.harga"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Ekstra</option>
                        @foreach ($ekstras as $ekstra)
                            <option value="{{ $ekstra->id }}" data-harga="{{ $ekstra->harga_default }}">{{ $ekstra->nama_ekstra }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="ekstra_id" />
                </div>

                <div class="mb-4">
                    <label for="harga" class="mb-1.5 block text-sm font-medium text-stone-700">Harga</label>
                    <input type="number" id="harga" name="harga" x-ref="harga_input" placeholder="Harga"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <x-form-error name="harga" />
                </div>

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

    <x-data-table searchPlaceholder="Cari ekstra paket...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Ekstra</th>
                    <th class="px-4 py-3">Harga Bawaan</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($paketEkstras as $paketEkstra)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $paketEkstra->ekstra->nama_ekstra }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($paketEkstra->ekstra->harga_default, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($paketEkstra->harga ?? $paketEkstra->ekstra->harga_default, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/paket-ekstra/' . $paketEkstra->id" />

                                <x-modal title="Edit Paket Ekstra">
                                    <form action="/admin/paket-ekstra/{{ $paketEkstra->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="paket_id" value="{{ $paketEkstra->paket_id }}">

                                        <div class="mb-4">
                                            <label for="ekstra_id_{{ $paketEkstra->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra</label>
                                            <select id="ekstra_id_{{ $paketEkstra->id }}" name="ekstra_id"
                                                @change="$refs['harga_input_' + {{ $paketEkstra->id }}].value = $event.target.options[$event.target.selectedIndex].dataset.harga"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Ekstra</option>
                                                @foreach ($ekstras as $ekstra)
                                                    <option value="{{ $ekstra->id }}" data-harga="{{ $ekstra->harga_default }}" @selected($ekstra->id == $paketEkstra->ekstra_id)>{{ $ekstra->nama_ekstra }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="ekstra_id" />
                                        </div>

                                        <x-form-input label="Harga" name="harga" type="number" :value="$paketEkstra->harga" placeholder="Harga" x-ref="{{ 'harga_input_' . $paketEkstra->id }}" />
                                        <x-form-error name="harga" />

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
