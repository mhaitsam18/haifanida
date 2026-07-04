@extends('layouts.app')

@section('content')
    <section class="py-10">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-8">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Tambah Jemaah</h2>
                <p class="mt-1 text-sm text-stone-500">Silakan lengkapi data jemaah dengan benar</p>
            </div>

            <form action="{{ route('pemesanan.jemaah.store', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                <div class="grid gap-6 lg:grid-cols-2">
                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-user-circle"></i> Data Pribadi
                        </h3>
                        <x-form-input label="Nama Lengkap (Sesuai KTP)" name="nama_lengkap" required placeholder="Masukkan nama lengkap" />
                        <x-form-input label="Email" name="email" type="email" required placeholder="nama@email.com" />
                        <x-form-input label="Nomor Ponsel" name="nomor_telepon" required placeholder="Contoh: 08123456789" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto <span class="text-maroon-700">*</span></label>
                            <div class="mb-3 text-center">
                                <img id="preview-image" src="{{ asset('storage/jemaah-foto/pas-foto.jpg') }}" alt="Preview" class="mx-auto h-36 w-auto rounded-lg border border-cream-200">
                            </div>
                            <label for="foto" class="flex cursor-pointer items-center justify-center gap-2 rounded-lg bg-maroon-700 py-2.5 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                                <i class="bx bx-upload"></i> Pilih Foto
                            </label>
                            <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(this)" class="hidden">
                        </div>

                        <x-form-input label="Nomor KTP" name="nomor_ktp" required placeholder="16 digit nomor KTP" />
                    </x-card>

                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-info-circle"></i> Informasi Kelahiran &amp; Data Diri
                        </h3>
                        <x-form-input label="Kota Tempat Lahir" name="tempat_lahir" required placeholder="Masukkan kota tempat lahir" />
                        <x-form-input label="Tanggal Lahir" name="tanggal_lahir" type="date" required />

                        <div class="mb-4 grid grid-cols-2 gap-4">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kelamin <span class="text-maroon-700">*</span></label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki" checked class="text-maroon-700 focus:ring-maroon-400"> Laki-laki
                                    </label>
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="text-maroon-700 focus:ring-maroon-400"> Perempuan
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-stone-700">Golongan Darah</label>
                                <div class="flex flex-wrap gap-3">
                                    @foreach (['A', 'B', 'AB', 'O'] as $goldar)
                                        <label class="flex items-center gap-1.5 text-sm text-stone-700">
                                            <input type="radio" name="golongan_darah" value="{{ $goldar }}" class="text-maroon-700 focus:ring-maroon-400"> {{ $goldar }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Kewarganegaraan <span class="text-maroon-700">*</span></label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                    <input type="radio" name="kewarganegaraan" value="WNI" checked class="text-maroon-700 focus:ring-maroon-400"> WNI
                                </label>
                                <label class="flex items-center gap-2 text-sm text-stone-700">
                                    <input type="radio" name="kewarganegaraan" value="WNA" class="text-maroon-700 focus:ring-maroon-400"> WNA
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Tingkat Pendidikan</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ([
                                    'SD' => 'SD/MI/Sederajat', 'SLTP' => 'SMP/MTs/Sederajat', 'SLTA' => 'SMA/SMK/MA/Sederajat', 'D1/D2/D3' => 'D1/D2/D3',
                                    'D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3',
                                ] as $value => $label)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="tingkat_pendidikan" value="{{ $value }}" class="text-maroon-700 focus:ring-maroon-400"> {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <x-form-input label="Pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan" />
                    </x-card>

                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-map"></i> Alamat Lengkap
                        </h3>
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
                            <label for="kabupaten_id" class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten/Kota <span class="text-maroon-700">*</span></label>
                            <select id="kabupaten_id" name="kabupaten_id" required
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        <x-form-input label="Kecamatan" name="kecamatan" required placeholder="Masukkan kecamatan" />
                        <x-form-input label="Desa/Kelurahan" name="kelurahan" required placeholder="Masukkan desa/kelurahan" />
                        <x-form-input label="Kode Pos" name="kode_pos" placeholder="Masukkan kode pos" />
                        <x-form-textarea label="Detail Alamat" name="alamat" :rows="3" required placeholder="Contoh: Jl. Raya Bogor No. 123, RT 01/RW 02" />
                    </x-card>

                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-id-card"></i> Informasi Paspor
                        </h3>
                        <x-form-input label="Nomor Paspor" name="nomor_paspor" placeholder="Masukkan nomor paspor" />
                        <x-form-input label="Nama Sesuai Paspor" name="nama_sesuai_paspor" placeholder="Nama lengkap sesuai paspor" />
                        <x-form-input label="Tempat Dikeluarkan (Kota/Kabupaten)" name="tempat_dikeluarkan" placeholder="Tempat paspor dikeluarkan" />
                        <x-form-input label="Tanggal Dikeluarkan" name="tanggal_dikeluarkan" type="date" />
                        <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" />
                    </x-card>

                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-heart"></i> Kontak Darurat
                        </h3>
                        <x-form-input label="Nama Keluarga Terdekat" name="nama_keluarga_terdekat" required placeholder="Masukkan nama keluarga terdekat" />
                        <x-form-input label="Kontak Keluarga Terdekat" name="kontak_keluarga_terdekat" required placeholder="Nomor telepon keluarga terdekat" />
                    </x-card>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <x-button variant="secondary" :href="route('pemesanan.jemaah.list', $pemesanan->id)">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                    <x-button type="submit">
                        <i class="bx bx-save"></i> Simpan Data
                    </x-button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.previewImage = function (input) {
                const file = input.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('preview-image').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            };

            document.getElementById('provinsi_id').addEventListener('change', function () {
                fetch('/get-kabupaten', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ provinsi_id: this.value }),
                })
                    .then(response => response.json())
                    .then(data => {
                        const kabupatenSelect = document.getElementById('kabupaten_id');
                        kabupatenSelect.innerHTML = '<option value="" selected disabled>Pilih Kabupaten</option>';
                        data.forEach(function (kabupaten) {
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
