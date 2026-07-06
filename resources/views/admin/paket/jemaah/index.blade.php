@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                <button type="button" onclick="printContent()" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50">
                    <i class="bx bx-printer"></i> Print
                </button>
                @if ($paket)
                    <x-button variant="secondary" :href="'/admin/paket/' . $paket->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Jemaah">
            <form action="/admin/jemaah" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <div class="grid gap-6 lg:grid-cols-3">
                    <div>
                        <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">Data Jemaah</h4>
                        <x-form-input label="Nama Lengkap (Sesuai KTP)" name="nama_lengkap" placeholder="Nama Lengkap" />
                        <x-form-error name="nama_lengkap" />

                        <x-form-input label="Email" name="email" type="email" placeholder="Email" />
                        <x-form-error name="email" />

                        <x-form-input label="Nomor Ponsel" name="nomor_telepon" placeholder="Nomor Ponsel" />
                        <x-form-error name="nomor_telepon" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                            <div class="mb-2">
                                <img x-show="previewUrl" :src="previewUrl" class="h-24 w-24 rounded-lg border border-cream-200 object-cover">
                            </div>
                            <input type="file" name="foto" @change="preview($event)"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700">
                            <x-form-error name="foto" />
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Grup</label>
                            <select name="grup_id"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Grup</option>
                                @foreach ($createGrups as $grup)
                                    <option value="{{ $grup->id }}">{{ $grup->nama_grup }}</option>
                                @endforeach
                            </select>
                            <x-form-error name="grup_id" />
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Mahram (Khusus Jemaah perempuan)</label>
                            <select name="mahram_id"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Mahram</option>
                                @foreach ($createMahramCandidates as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            <x-form-error name="mahram_id" />
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Hubungan dengan Mahram</label>
                            <select name="hubungan_mahram"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Hubungan</option>
                                @foreach (['Ayah', 'Anak', 'Suami', 'Saudara Kandung', 'Kakek', 'Cucu', 'Paman', 'Keponakan'] as $hubungan)
                                    <option value="{{ $hubungan }}">{{ $hubungan }}</option>
                                @endforeach
                            </select>
                            <x-form-error name="hubungan_mahram" />
                        </div>
                    </div>

                    <div>
                        <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">&nbsp;</h4>
                        <x-form-input label="Nomor KTP" name="nomor_ktp" type="number" placeholder="Nomor KTP" />
                        <x-form-error name="nomor_ktp" />

                        <x-form-input label="Nama Sesuai Paspor" name="nama_sesuai_paspor" placeholder="Nama Sesuai Paspor" />
                        <x-form-error name="nama_sesuai_paspor" />

                        <x-form-input label="Kota Tempat Lahir" name="tempat_lahir" placeholder="Kota Tempat Lahir" />
                        <x-form-error name="tempat_lahir" />

                        <x-form-input label="Tanggal Lahir" name="tanggal_lahir" type="date" />
                        <x-form-error name="tanggal_lahir" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kelamin</label>
                            <div class="flex gap-4">
                                @foreach (['Laki-laki', 'Perempuan'] as $jk)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="jenis_kelamin" value="{{ $jk }}" class="text-maroon-700 focus:ring-maroon-400">
                                        {{ $jk }}
                                    </label>
                                @endforeach
                            </div>
                            <x-form-error name="jenis_kelamin" />
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Golongan Darah</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach (['A', 'B', 'AB', 'O'] as $gd)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="golongan_darah" value="{{ $gd }}" class="text-maroon-700 focus:ring-maroon-400">
                                        {{ $gd }}
                                    </label>
                                @endforeach
                            </div>
                            <x-form-error name="golongan_darah" />
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Kewarganegaraan</label>
                            <div class="flex gap-4">
                                @foreach (['WNI', 'WNA'] as $wn)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="kewarganegaraan" value="{{ $wn }}" class="text-maroon-700 focus:ring-maroon-400">
                                        {{ $wn }}
                                    </label>
                                @endforeach
                            </div>
                            <x-form-error name="kewarganegaraan" />
                        </div>

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

                        <x-form-input label="Desa / Kelurahan" name="kelurahan" placeholder="Desa / Kelurahan" />
                        <x-form-error name="kelurahan" />

                        <x-form-input label="Kode Pos" name="kode_pos" type="number" placeholder="Kode Pos" />
                        <x-form-error name="kode_pos" />

                        <x-form-textarea label="Detail Alamat" name="alamat" placeholder="Detail Alamat" />
                        <x-form-error name="alamat" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Tingkat Pendidikan</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ([
                                    'SD' => 'SD/MI/Sederajat', 'SLTP' => 'SLTP/SMP/MTs/Sederajat', 'SLTA' => 'SLTA/SMA/MA/Sederajat',
                                    'D1/D2/D3' => 'D1/D2/D3', 'D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3',
                                ] as $value => $label)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="tingkat_pendidikan" value="{{ $value }}" class="text-maroon-700 focus:ring-maroon-400">
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                            <x-form-error name="tingkat_pendidikan" />
                        </div>

                        <x-form-input label="Pekerjaan" name="pekerjaan" placeholder="Pekerjaan" />
                        <x-form-error name="pekerjaan" />
                    </div>

                    <div>
                        <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">Data Paspor</h4>
                        <x-form-input label="Nomor Paspor" name="nomor_paspor" placeholder="Nomor Paspor" />
                        <x-form-error name="nomor_paspor" />

                        <x-form-input label="Tempat dikeluarkan (Kota/Kabupaten)" name="tempat_dikeluarkan" placeholder="Tempat dikeluarkan" />
                        <x-form-error name="tempat_dikeluarkan" />

                        <x-form-input label="Tanggal dikeluarkan" name="tanggal_dikeluarkan" type="date" />
                        <x-form-error name="tanggal_dikeluarkan" />

                        <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" />
                        <x-form-error name="tanggal_kadaluarsa" />

                        <h4 class="font-display mb-3 mt-4 text-base font-semibold text-maroon-900">Data Lainnya</h4>
                        <div class="mb-4 flex flex-wrap gap-4">
                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                <input type="checkbox" value="1" name="pernah_umroh" class="rounded text-maroon-700 focus:ring-maroon-400">
                                Pernah Umroh?
                            </label>
                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                <input type="checkbox" value="1" name="pernah_haji" class="rounded text-maroon-700 focus:ring-maroon-400">
                                Pernah Haji?
                            </label>
                        </div>
                        <x-form-error name="pernah_umroh" />
                        <x-form-error name="pernah_haji" />

                        <x-form-input label="Nama Keluarga Terdekat" name="nama_keluarga_terdekat" placeholder="Nama Keluarga Terdekat" />
                        <x-form-error name="nama_keluarga_terdekat" />

                        <x-form-input label="Kontak Keluarga Terdekat" name="kontak_keluarga_terdekat" placeholder="Kontak Keluarga Terdekat" />
                        <x-form-error name="kontak_keluarga_terdekat" />

                        <div class="mt-6 flex justify-end gap-2">
                            <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                            <x-button type="submit">
                                <span x-show="!submitting">Simpan</span>
                                <span x-show="submitting">Menyimpan...</span>
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>
    </div>

    <div id="konten-yang-ingin-dicetak">
        <p class="mb-4 text-center font-display text-lg font-semibold text-maroon-900">
            Data Jema'ah Keberangkatan {{ Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}
        </p>

        <x-data-table searchPlaceholder="Cari jemaah...">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nama Lengkap</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Nomor Ponsel</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3 aksi-kolom">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @foreach ($jemaahs as $jemaah)
                        <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium text-stone-800">{{ $jemaah->nama_lengkap }}</td>
                            <td class="px-4 py-3">{{ $jemaah->email }}</td>
                            <td class="px-4 py-3">{{ $jemaah->nomor_telepon }}</td>
                            <td class="px-4 py-3"><img src="{{ asset('storage/' . $jemaah->foto) }}" alt="Foto" class="h-12 w-12 rounded-lg object-cover"></td>
                            <td class="px-4 py-3 aksi-kolom">
                                <div class="flex items-center gap-2" x-data="modalForm()">
                                    <a href="/admin/paket/{{ $paket->id }}/jemaah/{{ $jemaah->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                    <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                    <x-delete-form :action="'/admin/jemaah/' . $jemaah->id" />

                                    <x-modal title="Edit Jemaah">
                                        <form action="/admin/jemaah/{{ $jemaah->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="pemesanan_id" value="{{ $jemaah->pemesanan_id }}">
                                            <div class="grid gap-6 lg:grid-cols-3">
                                                <div>
                                                    <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">Data Jemaah</h4>
                                                    <x-form-input label="Nama Lengkap (Sesuai KTP)" name="nama_lengkap" :value="$jemaah->nama_lengkap" placeholder="Nama Lengkap" />
                                                    <x-form-error name="nama_lengkap" />

                                                    <x-form-input label="Email" name="email" type="email" :value="$jemaah->email" placeholder="Email" />
                                                    <x-form-error name="email" />

                                                    <x-form-input label="Nomor Ponsel" name="nomor_telepon" :value="$jemaah->nomor_telepon" placeholder="Nomor Ponsel" />
                                                    <x-form-error name="nomor_telepon" />

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                                                        <div class="mb-2">
                                                            <img :src="previewUrl || '{{ $jemaah->foto ? asset('storage/' . $jemaah->foto) : '' }}'" class="h-24 w-24 rounded-lg border border-cream-200 object-cover">
                                                        </div>
                                                        <input type="file" name="foto" @change="preview($event)"
                                                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700">
                                                        <x-form-error name="foto" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Grup</label>
                                                        <select name="grup_id"
                                                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                            <option value="" selected disabled>Pilih Grup</option>
                                                            @foreach (optional(optional($jemaah->grup)->paket)->grups ?? [] as $grup)
                                                                <option value="{{ $grup->id }}" @selected($grup->id == $jemaah->grup_id)>{{ $grup->nama_grup }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-form-error name="grup_id" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Mahram (Khusus Jemaah perempuan)</label>
                                                        <select name="mahram_id"
                                                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                            <option value="" selected disabled>Pilih Mahram</option>
                                                            @foreach ($editMahramCandidates as $item)
                                                                <option value="{{ $item->id }}" @selected($item->id == $jemaah->mahram_id)>{{ $item->nama_lengkap }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-form-error name="mahram_id" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Hubungan dengan Mahram</label>
                                                        <select name="hubungan_mahram"
                                                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                            <option value="" selected disabled>Pilih Hubungan</option>
                                                            @foreach (['Ayah', 'Anak', 'Suami', 'Saudara Kandung', 'Kakek', 'Cucu', 'Paman', 'Keponakan'] as $hubungan)
                                                                <option value="{{ $hubungan }}" @selected($jemaah->hubungan_mahram == $hubungan)>{{ $hubungan }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-form-error name="hubungan_mahram" />
                                                    </div>
                                                </div>

                                                <div>
                                                    <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">&nbsp;</h4>
                                                    <x-form-input label="Nomor KTP" name="nomor_ktp" type="number" :value="$jemaah->nomor_ktp" placeholder="Nomor KTP" />
                                                    <x-form-error name="nomor_ktp" />

                                                    <x-form-input label="Nama Sesuai Paspor" name="nama_sesuai_paspor" :value="$jemaah->nama_sesuai_paspor" placeholder="Nama Sesuai Paspor" />
                                                    <x-form-error name="nama_sesuai_paspor" />

                                                    <x-form-input label="Kota Tempat Lahir" name="tempat_lahir" :value="$jemaah->tempat_lahir" placeholder="Kota Tempat Lahir" />
                                                    <x-form-error name="tempat_lahir" />

                                                    <x-form-input label="Tanggal Lahir" name="tanggal_lahir" type="date" :value="$jemaah->tanggal_lahir" />
                                                    <x-form-error name="tanggal_lahir" />

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kelamin</label>
                                                        <div class="flex gap-4">
                                                            @foreach (['Laki-laki', 'Perempuan'] as $jk)
                                                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                                                    <input type="radio" name="jenis_kelamin" value="{{ $jk }}" class="text-maroon-700 focus:ring-maroon-400" @checked($jemaah->jenis_kelamin == $jk)>
                                                                    {{ $jk }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                        <x-form-error name="jenis_kelamin" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Golongan Darah</label>
                                                        <div class="flex flex-wrap gap-4">
                                                            @foreach (['A', 'B', 'AB', 'O'] as $gd)
                                                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                                                    <input type="radio" name="golongan_darah" value="{{ $gd }}" class="text-maroon-700 focus:ring-maroon-400" @checked($jemaah->golongan_darah == $gd)>
                                                                    {{ $gd }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                        <x-form-error name="golongan_darah" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Kewarganegaraan</label>
                                                        <div class="flex gap-4">
                                                            @foreach (['WNI', 'WNA'] as $wn)
                                                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                                                    <input type="radio" name="kewarganegaraan" value="{{ $wn }}" class="text-maroon-700 focus:ring-maroon-400" @checked($jemaah->kewarganegaraan == $wn)>
                                                                    {{ $wn }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                        <x-form-error name="kewarganegaraan" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                                                        <select name="provinsi_id" x-ref="provinsiEdit{{ $jemaah->id }}" @change="loadKabupaten($event, $refs['kabupatenEdit{{ $jemaah->id }}'])"
                                                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                            <option value="" selected disabled>Pilih Provinsi</option>
                                                            @foreach ($provinsis as $provinsi)
                                                                <option value="{{ $provinsi->id }}" @selected($provinsi->id == $jemaah->provinsi_id)>{{ $provinsi->provinsi }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-form-error name="provinsi_id" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                                                        <select name="kabupaten_id" x-ref="kabupatenEdit{{ $jemaah->id }}"
                                                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                            <option value="" selected disabled>Pilih Kabupaten</option>
                                                            @foreach ($kabupatens as $kabupaten)
                                                                <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == $jemaah->kabupaten_id)>{{ $kabupaten->kabupaten }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-form-error name="kabupaten_id" />
                                                    </div>

                                                    <x-form-input label="Kecamatan" name="kecamatan" :value="$jemaah->kecamatan" placeholder="Kecamatan" />
                                                    <x-form-error name="kecamatan" />

                                                    <x-form-input label="Desa / Kelurahan" name="kelurahan" :value="$jemaah->kelurahan" placeholder="Desa / Kelurahan" />
                                                    <x-form-error name="kelurahan" />

                                                    <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="$jemaah->kode_pos" placeholder="Kode Pos" />
                                                    <x-form-error name="kode_pos" />

                                                    <x-form-textarea label="Detail Alamat" name="alamat" :value="$jemaah->alamat" placeholder="Detail Alamat" />
                                                    <x-form-error name="alamat" />

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Tingkat Pendidikan</label>
                                                        <div class="grid grid-cols-2 gap-2">
                                                            @foreach ([
                                                                'SD' => 'SD/MI/Sederajat', 'SLTP' => 'SLTP/SMP/MTs/Sederajat', 'SLTA' => 'SLTA/SMA/MA/Sederajat',
                                                                'D1/D2/D3' => 'D1/D2/D3', 'D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3',
                                                            ] as $value => $label)
                                                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                                                    <input type="radio" name="tingkat_pendidikan" value="{{ $value }}" class="text-maroon-700 focus:ring-maroon-400" @checked($jemaah->tingkat_pendidikan == $value)>
                                                                    {{ $label }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                        <x-form-error name="tingkat_pendidikan" />
                                                    </div>

                                                    <x-form-input label="Pekerjaan" name="pekerjaan" :value="$jemaah->pekerjaan" placeholder="Pekerjaan" />
                                                    <x-form-error name="pekerjaan" />
                                                </div>

                                                <div>
                                                    <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">Data Paspor</h4>
                                                    <x-form-input label="Nomor Paspor" name="nomor_paspor" :value="$jemaah->nomor_paspor" placeholder="Nomor Paspor" />
                                                    <x-form-error name="nomor_paspor" />

                                                    <x-form-input label="Tempat dikeluarkan (Kota/Kabupaten)" name="tempat_dikeluarkan" :value="$jemaah->tempat_dikeluarkan" placeholder="Tempat dikeluarkan" />
                                                    <x-form-error name="tempat_dikeluarkan" />

                                                    <x-form-input label="Tanggal dikeluarkan" name="tanggal_dikeluarkan" type="date" :value="$jemaah->tanggal_dikeluarkan" />
                                                    <x-form-error name="tanggal_dikeluarkan" />

                                                    <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="$jemaah->tanggal_kadaluarsa" />
                                                    <x-form-error name="tanggal_kadaluarsa" />

                                                    <h4 class="font-display mb-3 mt-4 text-base font-semibold text-maroon-900">Data Lainnya</h4>
                                                    <div class="mb-4 flex flex-wrap gap-4">
                                                        <label class="flex items-center gap-2 text-sm text-stone-700">
                                                            <input type="checkbox" value="1" name="pernah_umroh" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($jemaah->pernah_umroh)>
                                                            Pernah Umroh?
                                                        </label>
                                                        <label class="flex items-center gap-2 text-sm text-stone-700">
                                                            <input type="checkbox" value="1" name="pernah_haji" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($jemaah->pernah_haji)>
                                                            Pernah Haji?
                                                        </label>
                                                    </div>
                                                    <x-form-error name="pernah_umroh" />
                                                    <x-form-error name="pernah_haji" />

                                                    <x-form-input label="Nama Keluarga Terdekat" name="nama_keluarga_terdekat" :value="$jemaah->nama_keluarga_terdekat" placeholder="Nama Keluarga Terdekat" />
                                                    <x-form-error name="nama_keluarga_terdekat" />

                                                    <x-form-input label="Kontak Keluarga Terdekat" name="kontak_keluarga_terdekat" :value="$jemaah->kontak_keluarga_terdekat" placeholder="Kontak Keluarga Terdekat" />
                                                    <x-form-error name="kontak_keluarga_terdekat" />

                                                    <div class="mt-6 flex justify-end gap-2">
                                                        <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                                                        <x-button type="submit">
                                                            <span x-show="!submitting">Simpan</span>
                                                            <span x-show="submitting">Menyimpan...</span>
                                                        </x-button>
                                                    </div>
                                                </div>
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
    </div>
@endsection

@section('script')
    <style>
        @media print {
            .aksi-kolom {
                display: none !important;
            }
        }
    </style>
    <script>
        function printContent() {
            var printContents = document.getElementById("konten-yang-ingin-dicetak").cloneNode(true);

            var rows = printContents.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var actionCell = row.querySelector('td:last-child');
                if (actionCell) {
                    actionCell.style.display = 'none';
                }
            });
            var headRows = printContents.querySelectorAll('thead tr');
            headRows.forEach(function(row) {
                var actionCell = row.querySelector('th:last-child');
                if (actionCell) {
                    actionCell.style.display = 'none';
                }
            });

            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents.outerHTML;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
