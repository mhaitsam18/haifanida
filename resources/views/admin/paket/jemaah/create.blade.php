@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        <form action="/admin/jemaah" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-6 lg:grid-cols-3">
                <div>
                    <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">Data Jemaah</h4>
                    <x-form-input label="Nama Lengkap (Sesuai KTP)" name="nama_lengkap" :value="old('nama_lengkap')" placeholder="Nama Lengkap" />
                    <x-form-input label="Email" name="email" type="email" :value="old('email')" placeholder="Email" />
                    <x-form-input label="Nomor Ponsel" name="nomor_telepon" :value="old('nomor_telepon')" placeholder="Nomor Ponsel" />

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                        <div class="mb-2">
                            <img src="" class="img-preview h-24 w-24 rounded-lg border border-cream-200 object-cover" style="display:none">
                        </div>
                        <input type="file" id="foto" name="foto"
                            class="img-input w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700 @error('foto') border-red-400 @enderror">
                        @error('foto')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="grup_id" class="mb-1.5 block text-sm font-medium text-stone-700">Grup</label>
                        <select id="grup_id" name="grup_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Grup</option>
                            @foreach ($grups as $grup)
                                <option value="{{ $grup->id }}" @selected($grup->id == old('grup_id'))>{{ $grup->nama_grup }}</option>
                            @endforeach
                        </select>
                        @error('grup_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="mahram_id" class="mb-1.5 block text-sm font-medium text-stone-700">Mahram (Khusus Jemaah perempuan)</label>
                        <select id="mahram_id" name="mahram_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Mahram</option>
                            @foreach ($jemaahs as $item)
                                <option value="{{ $item->id }}" @selected($item->id == old('mahram_id', $item->mahram_id))>{{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        @error('mahram_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="hubungan_mahram" class="mb-1.5 block text-sm font-medium text-stone-700">Hubungan dengan Mahram</label>
                        <select id="hubungan_mahram" name="hubungan_mahram"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Hubungan</option>
                            @foreach (['Ayah', 'Anak', 'Suami', 'Saudara Kandung', 'Kakek', 'Cucu', 'Paman', 'Keponakan'] as $hubungan)
                                <option value="{{ $hubungan }}" @selected(old('hubungan_mahram') == $hubungan)>{{ $hubungan }}</option>
                            @endforeach
                        </select>
                        @error('hubungan_mahram')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">&nbsp;</h4>
                    <x-form-input label="Nomor KTP" name="nomor_ktp" type="number" :value="old('nomor_ktp')" placeholder="Nomor KTP" />
                    <x-form-input label="Nama Sesuai Paspor" name="nama_sesuai_paspor" :value="old('nama_sesuai_paspor')" placeholder="Nama Sesuai Paspor" />
                    <x-form-input label="Kota Tempat Lahir" name="tempat_lahir" :value="old('tempat_lahir')" placeholder="Kota Tempat Lahir" />
                    <x-form-input label="Tanggal Lahir" name="tanggal_lahir" type="date" :value="old('tanggal_lahir')" />

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            @foreach (['Laki-laki', 'Perempuan'] as $jk)
                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                    <input type="radio" name="jenis_kelamin" value="{{ $jk }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('jenis_kelamin') == $jk)>
                                    {{ $jk }}
                                </label>
                            @endforeach
                        </div>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Golongan Darah</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach (['A', 'B', 'AB', 'O'] as $gd)
                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                    <input type="radio" name="golongan_darah" value="{{ $gd }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('golongan_darah') == $gd)>
                                    {{ $gd }}
                                </label>
                            @endforeach
                        </div>
                        @error('golongan_darah')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Kewarganegaraan</label>
                        <div class="flex gap-4">
                            @foreach (['WNI', 'WNA'] as $wn)
                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                    <input type="radio" name="kewarganegaraan" value="{{ $wn }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('kewarganegaraan') == $wn)>
                                    {{ $wn }}
                                </label>
                            @endforeach
                        </div>
                        @error('kewarganegaraan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="provinsi_id" class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                        <select id="provinsi_id" name="provinsi_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Provinsi</option>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id'))>{{ $provinsi->provinsi }}</option>
                            @endforeach
                        </select>
                        @error('provinsi_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kabupaten_id" class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                        <select id="kabupaten_id" name="kabupaten_id"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Kabupaten</option>
                            @if (old('kabupaten_id'))
                                @foreach ($kabupatens as $kabupaten)
                                    <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == old('kabupaten_id'))>{{ $kabupaten->kabupaten }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('kabupaten_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-input label="Kecamatan" name="kecamatan" :value="old('kecamatan')" placeholder="Kecamatan" />
                    <x-form-input label="Desa / Kelurahan" name="kelurahan" :value="old('kelurahan')" placeholder="Desa / Kelurahan" />
                    <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="old('kode_pos')" placeholder="Kode Pos" />
                    <x-form-textarea label="Detail Alamat" name="alamat" :value="old('alamat')" placeholder="Detail Alamat" />

                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Tingkat Pendidikan</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ([
                                'SD' => 'SD/MI/Sederajat', 'SLTP' => 'SLTP/SMP/MTs/Sederajat', 'SLTA' => 'SLTA/SMA/MA/Sederajat',
                                'D1/D2/D3' => 'D1/D2/D3', 'D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3',
                            ] as $value => $label)
                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                    <input type="radio" name="tingkat_pendidikan" value="{{ $value }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('tingkat_pendidikan') == $value)>
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                        @error('tingkat_pendidikan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-input label="Pekerjaan" name="pekerjaan" :value="old('pekerjaan')" placeholder="Pekerjaan" />
                </div>

                <div>
                    <h4 class="font-display mb-3 text-base font-semibold text-maroon-900">Data Paspor</h4>
                    <x-form-input label="Nomor Paspor" name="nomor_paspor" :value="old('nomor_paspor')" placeholder="Nomor Paspor" />
                    <x-form-input label="Tempat dikeluarkan (Kota/Kabupaten)" name="tempat_dikeluarkan" :value="old('tempat_dikeluarkan')" placeholder="Tempat dikeluarkan" />
                    <x-form-input label="Tanggal dikeluarkan" name="tanggal_dikeluarkan" type="date" :value="old('tanggal_dikeluarkan')" />
                    <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="old('tanggal_kadaluarsa')" />

                    <h4 class="font-display mb-3 mt-4 text-base font-semibold text-maroon-900">Data Lainnya</h4>
                    <div class="mb-4 flex flex-wrap gap-4">
                        <label class="flex items-center gap-2 text-sm text-stone-700">
                            <input type="checkbox" value="1" name="pernah_umroh" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('pernah_umroh'))>
                            Pernah Umroh?
                        </label>
                        <label class="flex items-center gap-2 text-sm text-stone-700">
                            <input type="checkbox" value="1" name="pernah_haji" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('pernah_haji'))>
                            Pernah Haji?
                        </label>
                    </div>
                    @error('pernah_umroh')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                    @error('pernah_haji')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                    <x-form-input label="Nama Keluarga Terdekat" name="nama_keluarga_terdekat" :value="old('nama_keluarga_terdekat')" placeholder="Nama Keluarga Terdekat" />
                    <x-form-input label="Kontak Keluarga Terdekat" name="kontak_keluarga_terdekat" :value="old('kontak_keluarga_terdekat')" placeholder="Kontak Keluarga Terdekat" />

                    <div class="mt-6 flex justify-end gap-2">
                        <x-button variant="secondary" :href="'/admin/paket/' . $paket->id . '/jemaah'">Kembali</x-button>
                        <x-button type="submit">Simpan</x-button>
                    </div>
                </div>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('foto').addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector('.img-preview');
                    preview.src = e.target.result;
                    preview.style.display = '';
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('provinsi_id').addEventListener('change', function() {
                fetch('/get-kabupaten', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            provinsi_id: this.value
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        const kabupatenSelect = document.getElementById('kabupaten_id');
                        kabupatenSelect.innerHTML = '<option value="" selected disabled>Pilih Kabupaten</option>';
                        data.forEach(function(kabupaten) {
                            const option = document.createElement('option');
                            option.value = kabupaten.id;
                            option.textContent = kabupaten.kabupaten;
                            kabupatenSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
