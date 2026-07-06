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

        <x-modal title="Tambah Cabang">
            <form action="/admin/cabang" method="post" @submit="submit">
                @csrf
                <x-form-input label="Nama Cabang" name="nama_kantor" placeholder="Nama Cabang" />
                <x-form-error name="nama_kantor" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Perwakilan Induk</label>
                    <select name="induk_kantor_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected>Tidak ada (langsung di bawah Pusat)</option>
                        @foreach ($perwakilans as $perwakilan)
                            <option value="{{ $perwakilan->id }}">{{ $perwakilan->nama_kantor }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="induk_kantor_id" />
                </div>

                <x-form-input label="Nama Ketua" name="nama_ketua" placeholder="Nama Ketua" />
                <x-form-error name="nama_ketua" />

                <x-form-input label="Kontak" name="kontak_kantor" placeholder="Kontak" />
                <x-form-error name="kontak_kantor" />

                <x-form-input label="Nomor Surat Izin" name="surat_izin" placeholder="Nomor Surat Izin" />
                <x-form-error name="surat_izin" />

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

                <x-form-input label="Kecamatan" name="kecamatan" placeholder="Kecamatan" />
                <x-form-error name="kecamatan" />

                <x-form-textarea label="Detail Alamat" name="alamat_kantor" placeholder="Alamat" />
                <x-form-error name="alamat_kantor" />

                <x-form-input label="Kode Pos" name="kode_pos" type="number" placeholder="Kode Pos" />
                <x-form-error name="kode_pos" />

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

    <x-data-table searchPlaceholder="Cari cabang...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Cabang</th>
                    <th class="px-4 py-3">Perwakilan Induk</th>
                    <th class="px-4 py-3">Nama Ketua</th>
                    <th class="px-4 py-3">Kontak</th>
                    <th class="px-4 py-3">Surat Izin</th>
                    <th class="px-4 py-3">Kabupaten / Kota</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($cabangs as $cabang)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $cabang->nama_kantor }}</td>
                        <td class="px-4 py-3">{{ $cabang->indukKantor->nama_kantor ?? 'Pusat' }}</td>
                        <td class="px-4 py-3">{{ $cabang->nama_ketua }}</td>
                        <td class="px-4 py-3">{{ $cabang->kontak_kantor }}</td>
                        <td class="px-4 py-3">{{ $cabang->surat_izin ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $cabang->kabupaten->kabupaten ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/cabang/' . $cabang->id" />

                                <x-modal title="Edit Cabang">
                                    <form action="/admin/cabang/{{ $cabang->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <x-form-input label="Nama Cabang" name="nama_kantor" :value="$cabang->nama_kantor" placeholder="Nama Cabang" />
                                        <x-form-error name="nama_kantor" />

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Perwakilan Induk</label>
                                            <select name="induk_kantor_id"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected>Tidak ada (langsung di bawah Pusat)</option>
                                                @foreach ($perwakilans as $perwakilan)
                                                    <option value="{{ $perwakilan->id }}" @selected($perwakilan->id == $cabang->induk_kantor_id)>{{ $perwakilan->nama_kantor }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="induk_kantor_id" />
                                        </div>

                                        <x-form-input label="Nama Ketua" name="nama_ketua" :value="$cabang->nama_ketua" placeholder="Nama Ketua" />
                                        <x-form-error name="nama_ketua" />

                                        <x-form-input label="Kontak" name="kontak_kantor" :value="$cabang->kontak_kantor" placeholder="Kontak" />
                                        <x-form-error name="kontak_kantor" />

                                        <x-form-input label="Nomor Surat Izin" name="surat_izin" :value="$cabang->surat_izin" placeholder="Nomor Surat Izin" />
                                        <x-form-error name="surat_izin" />

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                                            <select name="provinsi_id" x-ref="provinsiEdit{{ $cabang->id }}" @change="loadKabupaten($event, $refs['kabupatenEdit{{ $cabang->id }}'])"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Provinsi</option>
                                                @foreach ($provinsis as $provinsi)
                                                    <option value="{{ $provinsi->id }}" @selected($provinsi->id == ($cabang->kabupaten->provinsi_id ?? null))>{{ $provinsi->provinsi }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="provinsi_id" />
                                        </div>

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                                            <select name="kabupaten_id" x-ref="kabupatenEdit{{ $cabang->id }}"
                                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Kabupaten</option>
                                                @foreach ($kabupatens as $kabupaten)
                                                    <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == $cabang->kabupaten_id)>{{ $kabupaten->kabupaten }}</option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="kabupaten_id" />
                                        </div>

                                        <x-form-input label="Kecamatan" name="kecamatan" :value="$cabang->kecamatan" placeholder="Kecamatan" />
                                        <x-form-error name="kecamatan" />

                                        <x-form-textarea label="Detail Alamat" name="alamat_kantor" :value="$cabang->alamat_kantor" placeholder="Alamat" />
                                        <x-form-error name="alamat_kantor" />

                                        <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="$cabang->kode_pos" placeholder="Kode Pos" />
                                        <x-form-error name="kode_pos" />

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
