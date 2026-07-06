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

        <x-modal title="Tambah Grup" maxWidth="max-w-3xl">
            <form action="/admin/grup" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="paket_id" value="{{ $paket->id ?? '' }}">

                <div class="grid gap-x-6 md:grid-cols-2">
                    <div>
                        @if (!$paket)
                            <div class="mb-4">
                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Paket <span class="text-maroon-700">*</span></label>
                                <select name="paket_id"
                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                    <option value="" selected disabled>Pilih Paket</option>
                                    @foreach ($pakets as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_paket }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name="paket_id" />
                            </div>
                        @endif
                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Agen</label>
                            <select name="agen_id"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="">Pilih Agen</option>
                                @foreach ($agens as $agen)
                                    <option value="{{ $agen->id }}">{{ $agen->user->name }}</option>
                                @endforeach
                            </select>
                            <x-form-error name="agen_id" />
                        </div>
                        <x-form-input label="Nama Grup" name="nama_grup" placeholder="Nama Grup" required />
                        <x-form-error name="nama_grup" />
                        <x-form-input label="Ketua Grup" name="ketua_grup" placeholder="Ketua Grup" />
                        <x-form-error name="ketua_grup" />
                    </div>
                    <div>
                        <x-form-input label="Status Grup" name="status_grup" placeholder="Status Grup" />
                        <x-form-error name="status_grup" />
                        <x-form-input label="Kuota Grup" name="kuota_grup" type="number" placeholder="Kuota Grup" />
                        <x-form-error name="kuota_grup" />
                        <x-form-textarea label="Keterangan Grup" name="keterangan_grup" placeholder="Keterangan Grup" />
                        <x-form-error name="keterangan_grup" />
                    </div>
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div>

    <x-data-table searchPlaceholder="Cari grup...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Agen</th>
                    <th class="px-4 py-3">Nama Grup</th>
                    <th class="px-4 py-3">Ketua Grup</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Kuota</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($grups as $grup)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $grup->agen->user->name ?? null }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $grup->nama_grup }}</td>
                        <td class="px-4 py-3">{{ $grup->ketua_grup }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $grup->keterangan_grup }}</td>
                        <td class="px-4 py-3">{{ $grup->kuota_grup }}</td>
                        <td class="px-4 py-3">{{ $grup->status_grup }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/grup/{{ $grup->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/grup/' . $grup->id" />

                                <x-modal title="Edit Grup" maxWidth="max-w-3xl">
                                    <form action="/admin/grup/{{ $grup->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="paket_id" value="{{ $grup->paket_id }}">

                                        <div class="grid gap-x-6 md:grid-cols-2">
                                            <div>
                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Agen</label>
                                                    <select name="agen_id"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="">Pilih Agen</option>
                                                        @foreach ($agens as $agen)
                                                            <option value="{{ $agen->id }}" @selected($agen->id == $grup->agen_id)>{{ $agen->user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="agen_id" />
                                                </div>
                                                <x-form-input label="Nama Grup" name="nama_grup" :value="$grup->nama_grup" placeholder="Nama Grup" required />
                                                <x-form-error name="nama_grup" />
                                                <x-form-input label="Ketua Grup" name="ketua_grup" :value="$grup->ketua_grup" placeholder="Ketua Grup" />
                                                <x-form-error name="ketua_grup" />
                                            </div>
                                            <div>
                                                <x-form-input label="Status Grup" name="status_grup" :value="$grup->status_grup" placeholder="Status Grup" />
                                                <x-form-error name="status_grup" />
                                                <x-form-input label="Kuota Grup" name="kuota_grup" type="number" :value="$grup->kuota_grup" placeholder="Kuota Grup" />
                                                <x-form-error name="kuota_grup" />
                                                <x-form-textarea label="Keterangan Grup" name="keterangan_grup" :value="$grup->keterangan_grup" placeholder="Keterangan Grup" />
                                                <x-form-error name="keterangan_grup" />
                                            </div>
                                        </div>

                                        <div class="mt-4 flex justify-end gap-2">
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
