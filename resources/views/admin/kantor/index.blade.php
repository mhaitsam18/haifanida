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

        <x-modal title="Tambah Kantor" maxWidth="max-w-4xl">
            <form action="/admin/kantor" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <x-form-input label="Nama Kantor" name="nama_kantor" placeholder="Nama Kantor" />
                        <x-form-error name="nama_kantor" />

                        <x-form-input label="Nama Ketua/Pimpinan" name="nama_ketua" placeholder="Nama Ketua/Pimpinan" />
                        <x-form-error name="nama_ketua" />

                        <x-form-input label="Kontak Kantor" name="kontak_kantor" placeholder="Kontak Kantor" />
                        <x-form-error name="kontak_kantor" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                            <select name="provinsi_id" x-ref="provinsiCreate" @change="loadKabupaten($event, $refs.kabupatenCreate)"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->provinsi }}</option>
                                @endforeach
                            </select>
                            <x-form-error name="provinsi_id" />
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                            <select name="kabupaten_id" x-ref="kabupatenCreate"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Kabupaten</option>
                            </select>
                            <x-form-error name="kabupaten_id" />
                        </div>

                        <x-form-textarea label="Detail Alamat" name="alamat_kantor" placeholder="Alamat Kantor" />
                        <x-form-error name="alamat_kantor" />

                        <x-form-input label="Kode Pos" name="kode_pos" type="number" placeholder="Kode Pos" />
                        <x-form-error name="kode_pos" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kantor</label>
                            <select name="jenis_kantor"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Jenis Kantor</option>
                                <option value="pusat">Pusat</option>
                                <option value="perwakilan">Perwakilan</option>
                                <option value="cabang">Cabang</option>
                                <option value="agen">Agen</option>
                            </select>
                            <x-form-error name="jenis_kantor" />
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto Kantor</label>
                            <input type="file" name="foto_kantor" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <x-form-error name="foto_kantor" />
                        </div>
                    </div>

                    <div>
                        <x-card title="Pratinjau Foto">
                            <img x-show="previewUrl" :src="previewUrl" alt="" class="aspect-4/3 w-full rounded-lg object-cover">
                        </x-card>
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

    <x-data-table searchPlaceholder="Cari kantor...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Nama Kantor</th>
                    <th class="px-4 py-3">Nama Ketua</th>
                    <th class="px-4 py-3">Kontak</th>
                    <th class="px-4 py-3">Provinsi</th>
                    <th class="px-4 py-3">Kabupaten</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kantors as $kantor)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ ucfirst($kantor->jenis_kantor) }}</x-badge></td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $kantor->nama_kantor }}</td>
                        <td class="px-4 py-3">{{ $kantor->nama_ketua }}</td>
                        <td class="px-4 py-3">{{ $kantor->kontak_kantor }}</td>
                        <td class="px-4 py-3">{{ $kantor->kabupaten->provinsi->provinsi ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $kantor->kabupaten->kabupaten ?? '-' }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $kantor->alamat_kantor }}</td>
                        <td class="px-4 py-3">
                            @if ($kantor->foto_kantor)
                                <img src="{{ asset('storage/' . $kantor->foto_kantor) }}" alt="Foto Kantor" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/kantor/' . $kantor->id" />

                                <x-modal title="Edit Kantor" maxWidth="max-w-4xl">
                                    <form action="/admin/kantor/{{ $kantor->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <div class="lg:col-span-2">
                                                <x-form-input label="Nama Kantor" name="nama_kantor" :value="$kantor->nama_kantor" placeholder="Nama Kantor" />
                                                <x-form-error name="nama_kantor" />

                                                <x-form-input label="Nama Ketua/Pimpinan" name="nama_ketua" :value="$kantor->nama_ketua" placeholder="Nama Ketua/Pimpinan" />
                                                <x-form-error name="nama_ketua" />

                                                <x-form-input label="Kontak Kantor" name="kontak_kantor" :value="$kantor->kontak_kantor" placeholder="Kontak Kantor" />
                                                <x-form-error name="kontak_kantor" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                                                    <select name="provinsi_id" x-ref="provinsiEdit{{ $kantor->id }}" @change="loadKabupaten($event, $refs['kabupatenEdit{{ $kantor->id }}'])"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Provinsi</option>
                                                        @foreach ($provinsis as $provinsi)
                                                            <option value="{{ $provinsi->id }}" @selected($provinsi->id == ($kantor->kabupaten->provinsi_id ?? null))>{{ $provinsi->provinsi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="provinsi_id" />
                                                </div>

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                                                    <select name="kabupaten_id" x-ref="kabupatenEdit{{ $kantor->id }}"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Kabupaten</option>
                                                        @foreach ($kabupatens as $kabupaten)
                                                            <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == $kantor->kabupaten_id)>{{ $kabupaten->kabupaten }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="kabupaten_id" />
                                                </div>

                                                <x-form-textarea label="Detail Alamat" name="alamat_kantor" :value="$kantor->alamat_kantor" placeholder="Alamat Kantor" />
                                                <x-form-error name="alamat_kantor" />

                                                <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="$kantor->kode_pos" placeholder="Kode Pos" />
                                                <x-form-error name="kode_pos" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kantor</label>
                                                    <select name="jenis_kantor"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Jenis Kantor</option>
                                                        <option value="pusat" @selected($kantor->jenis_kantor == 'pusat')>Pusat</option>
                                                        <option value="perwakilan" @selected($kantor->jenis_kantor == 'perwakilan')>Perwakilan</option>
                                                        <option value="cabang" @selected($kantor->jenis_kantor == 'cabang')>Cabang</option>
                                                        <option value="agen" @selected($kantor->jenis_kantor == 'agen')>Agen</option>
                                                    </select>
                                                    <x-form-error name="jenis_kantor" />
                                                </div>

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto Kantor</label>
                                                    <input type="file" name="foto_kantor" @change="preview($event)"
                                                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    <x-form-error name="foto_kantor" />
                                                </div>
                                            </div>

                                            <div>
                                                <x-card title="Pratinjau Foto">
                                                    <img :src="previewUrl || '{{ $kantor->foto_kantor ? asset('storage/' . $kantor->foto_kantor) : '' }}'" alt="" class="aspect-4/3 w-full rounded-lg object-cover">
                                                </x-card>
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
