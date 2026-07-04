@extends('layouts.app')

@section('content')
    <section class="py-12">
        <div class="mx-auto max-w-6xl px-4">
            <div class="mb-8">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">
                    <i class="bx bx-user-circle align-middle text-maroon-700"></i> Identitas dan Berkas
                </h2>
                <p class="mt-1 text-sm text-stone-500">Lengkapi data profil Anda dengan informasi yang benar</p>
            </div>

            <form action="{{ route('member.identitas.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="grid gap-6 lg:grid-cols-2">
                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-lock-alt"></i> Autentikasi
                        </h3>
                        <x-form-input label="Nama Lengkap (Sesuai KTP)" name="name" :value="$member->user->name" required />
                        <x-form-input label="Email" name="email" type="email" :value="$member->user->email" required />
                        <div id="email-availability" class="-mt-3 mb-3 text-xs"></div>
                        <x-form-input label="Username" name="username" :value="$member->user->username" required />
                        <div id="username-availability" class="-mt-3 mb-3 text-xs"></div>
                        <x-form-input label="Nomor Ponsel" name="phone_number" :value="$member->user->phone_number" required />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto Jemaah <span class="text-maroon-700">*</span></label>
                            <div class="mb-3 text-center">
                                <img id="preview-image" src="{{ $member->foto ? asset('storage/' . $member->foto) : asset('storage/jemaah-foto/pas-foto.jpg') }}"
                                    class="mx-auto h-36 w-auto rounded-lg border border-cream-200">
                            </div>
                            <label for="foto" class="flex cursor-pointer items-center justify-center gap-2 rounded-lg bg-maroon-700 py-2.5 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                                <i class="bx bx-upload"></i> Pilih Foto Jemaah
                            </label>
                            <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(this)" class="hidden">
                            @error('foto')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </x-card>

                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-user"></i> Biodata Member
                        </h3>
                        <x-form-input label="Nomor KTP" name="nomor_ktp" :value="$member->nomor_ktp" required />
                        <x-form-input label="Kota Tempat Lahir" name="tempat_lahir" :value="$member->tempat_lahir" required />
                        <x-form-input label="Tanggal Lahir" name="tanggal_lahir" type="date" :value="$member->tanggal_lahir" required />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kelamin <span class="text-maroon-700">*</span></label>
                            <div class="flex gap-4">
                                @foreach (['Laki-laki' => 'male', 'Perempuan' => 'female'] as $label => $icon)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="jenis_kelamin" value="{{ $label }}"
                                            class="text-maroon-700 focus:ring-maroon-400"
                                            @checked(old('jenis_kelamin', $member->jenis_kelamin) == $label)>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Golongan Darah <span class="text-maroon-700">*</span></label>
                            <div class="flex flex-wrap gap-4">
                                @foreach (['A', 'B', 'AB', 'O'] as $bloodType)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="golongan_darah" value="{{ $bloodType }}"
                                            class="text-maroon-700 focus:ring-maroon-400"
                                            @checked(old('golongan_darah', $member->golongan_darah) == $bloodType)>
                                        {{ $bloodType }}
                                    </label>
                                @endforeach
                            </div>
                            @error('golongan_darah')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Kewarganegaraan <span class="text-maroon-700">*</span></label>
                            <div class="flex gap-4">
                                @foreach (['WNI', 'WNA'] as $citizenship)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="kewarganegaraan" value="{{ $citizenship }}"
                                            class="text-maroon-700 focus:ring-maroon-400"
                                            @checked(old('kewarganegaraan', $member->kewarganegaraan) == $citizenship)>
                                        {{ $citizenship }}
                                    </label>
                                @endforeach
                            </div>
                            @error('kewarganegaraan')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Tingkat Pendidikan <span class="text-maroon-700">*</span></label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ([
                                    'SD' => 'SD/MI/Sederajat', 'SLTP' => 'SMP/MTs/Sederajat', 'SLTA' => 'SMA/SMK/MA/Sederajat', 'D1/D2/D3' => 'D1/D2/D3',
                                    'D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3',
                                ] as $value => $label)
                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                        <input type="radio" name="tingkat_pendidikan" value="{{ $value }}"
                                            class="text-maroon-700 focus:ring-maroon-400"
                                            @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == $value)>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                            @error('tingkat_pendidikan')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-form-input label="Pekerjaan" name="pekerjaan" :value="$member->pekerjaan" required />
                    </x-card>

                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-map"></i> Alamat Lengkap
                        </h3>
                        <div class="mb-4">
                            <label for="provinsi_id" class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi <span class="text-maroon-700">*</span></label>
                            <select id="provinsi_id" name="provinsi_id" required
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id', $member->provinsi_id))>{{ $provinsi->provinsi }}</option>
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
                                <option value="" selected disabled>Pilih Kabupaten</option>
                                @foreach ($kabupatens as $kabupaten)
                                    <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == old('kabupaten_id', $member->kabupaten_id))>{{ $kabupaten->kabupaten }}</option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <x-form-input label="Kecamatan" name="kecamatan" :value="$member->kecamatan" required />
                        <x-form-input label="Desa/Kelurahan" name="kelurahan" :value="$member->kelurahan" required />
                        <x-form-input label="Kode Pos" name="kode_pos" :value="$member->kode_pos" required />
                        <x-form-textarea label="Detail Alamat" name="alamat" :value="$member->alamat" :rows="3" required placeholder="Contoh: Jl. Raya Bogor No. 123, RT 01/RW 02" />
                    </x-card>

                    <x-card>
                        <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                            <i class="bx bx-id-card"></i> Data Paspor dan Informasi Tambahan
                        </h3>
                        <x-form-input label="Nomor Paspor" name="nomor_paspor" :value="$member->nomor_paspor" />
                        <x-form-input label="Nama Sesuai Paspor" name="nama_sesuai_paspor" :value="$member->nama_sesuai_paspor" />
                        <x-form-input label="Tempat Dikeluarkan (Kota/Kabupaten)" name="tempat_dikeluarkan" :value="$member->tempat_dikeluarkan" />
                        <x-form-input label="Tanggal Dikeluarkan" name="tanggal_dikeluarkan" type="date" :value="$member->tanggal_dikeluarkan" />
                        <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="$member->tanggal_kadaluarsa" />

                        <hr class="my-4 border-cream-200">
                        <h4 class="mb-3 text-sm font-semibold text-maroon-800">Informasi Tambahan</h4>
                        <div class="mb-4 flex flex-wrap gap-4">
                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                <input type="checkbox" value="1" name="pernah_umroh" class="rounded text-maroon-700 focus:ring-maroon-400"
                                    @checked(old('pernah_umroh', $member->pernah_umroh))>
                                <i class="bx bx-cube-alt"></i> Pernah Umroh?
                            </label>
                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                <input type="checkbox" value="1" name="pernah_haji" class="rounded text-maroon-700 focus:ring-maroon-400"
                                    @checked(old('pernah_haji', $member->pernah_haji))>
                                <i class="bx bxs-building-house"></i> Pernah Haji?
                            </label>
                        </div>
                        @error('pernah_umroh')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        @error('pernah_haji')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror

                        <x-form-input label="Nama Keluarga Terdekat" name="nama_keluarga_terdekat" :value="$member->nama_keluarga_terdekat" required />
                        <x-form-input label="Kontak Keluarga Terdekat" name="kontak_keluarga_terdekat" :value="$member->kontak_keluarga_terdekat" required />
                    </x-card>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <x-button variant="secondary" :href="route('member.profile', ['mode' => 'show'])">
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
            const provinsiSelect = document.getElementById('provinsi_id');
            const kabupatenSelect = document.getElementById('kabupaten_id');
            const savedKabupaten = "{{ old('kabupaten_id', $member->kabupaten_id ?? '') }}";

            provinsiSelect.addEventListener('change', function () {
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
                        kabupatenSelect.innerHTML = '<option value="" selected disabled>Pilih Kabupaten</option>';
                        data.forEach(function (kabupaten) {
                            const option = document.createElement('option');
                            option.value = kabupaten.id;
                            option.textContent = kabupaten.kabupaten;
                            kabupatenSelect.appendChild(option);
                        });
                        if (savedKabupaten) {
                            kabupatenSelect.value = savedKabupaten;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

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

            function checkAvailability(inputId, resultId, urlPrefix, label) {
                const input = document.getElementById(inputId);
                input.addEventListener('blur', function () {
                    if (!this.value) return;
                    fetch(urlPrefix + '/' + encodeURIComponent(this.value), {
                        headers: { 'Accept': 'application/json' },
                    })
                        .then(response => response.json())
                        .then(data => {
                            const available = data.status === 'available';
                            const el = document.getElementById(resultId);
                            el.textContent = available ? label + ' tersedia' : label + ' sudah digunakan';
                            el.style.color = available ? '#15803d' : '#dc2626';
                        })
                        .catch(error => console.error('Error:', error));
                });
            }

            checkAvailability('email', 'email-availability', '/check-email', 'Email');
            checkAvailability('username', 'username-availability', '/check-username', 'Username');
        });
    </script>
@endsection
