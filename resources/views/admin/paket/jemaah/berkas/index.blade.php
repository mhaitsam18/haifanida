@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                <x-button variant="secondary" :href="'/admin/jemaah/' . $jemaah->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Berkas">
            <form action="/admin/berkas-jemaah" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <input type="hidden" name="jemaah_id" value="{{ $jemaah->id }}">

                <div class="mb-4">
                    <label for="berkas_id" class="mb-1.5 block text-sm font-medium text-stone-700">Nama Berkas</label>
                    <select id="berkas_id" name="berkas_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Berkas</option>
                        @foreach ($berkass as $item_berkas)
                            <option value="{{ $item_berkas->id }}">{{ $item_berkas->nama_berkas }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="berkas_id" />
                </div>

                <div class="mb-4">
                    <label for="status" class="mb-1.5 block text-sm font-medium text-stone-700">Status</label>
                    <select id="status" name="status"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="tertunda">Tertunda</option>
                        <option value="diverifikasi">Diverifikasi</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <x-form-error name="status" />
                </div>

                <div class="mb-4">
                    <label for="file_path" class="mb-1.5 block text-sm font-medium text-stone-700">File Berkas</label>
                    <input type="file" id="file_path" name="file_path"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700">
                    <x-form-error name="file_path" />
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

    <x-data-table searchPlaceholder="Cari berkas...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Jema'ah</th>
                    <th class="px-4 py-3">Nama Berkas</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($berkasJemaahs as $berkas)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $berkas->jemaah->nama_lengkap }}</td>
                        <td class="px-4 py-3">{{ $berkas->berkas->nama_berkas }}</td>
                        <td class="px-4 py-3">{{ $berkas->status }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="{{ asset('storage/' . $berkas->file_path) }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Berkas</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/berkas-jemaah/' . $berkas->id" />

                                <x-modal title="Edit Berkas">
                                    <form action="/admin/berkas-jemaah/{{ $berkas->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="jemaah_id" value="{{ $berkas->jemaah_id }}">

                                        <div class="mb-4">
                                            <label for="berkas_id_{{ $berkas->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Nama Berkas</label>
                                            <select id="berkas_id_{{ $berkas->id }}" name="berkas_id"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Berkas</option>
                                                @foreach ($berkass as $item_berkas)
                                                    <option value="{{ $item_berkas->id }}" @selected($item_berkas->id == $berkas->berkas_id)>{{ $item_berkas->nama_berkas }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="berkas_id" />
                                        </div>

                                        <div class="mb-4">
                                            <label for="status_{{ $berkas->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Status</label>
                                            <select id="status_{{ $berkas->id }}" name="status"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="tertunda" @selected($berkas->status == 'tertunda')>Tertunda</option>
                                                <option value="diverifikasi" @selected($berkas->status == 'diverifikasi')>Diverifikasi</option>
                                                <option value="ditolak" @selected($berkas->status == 'ditolak')>Ditolak</option>
                                            </select>
                                            <x-form-error name="status" />
                                        </div>

                                        <div class="mb-4">
                                            <label for="file_path_{{ $berkas->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">File Berkas</label>
                                            <input type="file" id="file_path_{{ $berkas->id }}" name="file_path"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700">
                                            <x-form-error name="file_path" />
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
