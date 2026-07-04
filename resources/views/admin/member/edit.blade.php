@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <form action="/admin/member/{{ $member->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="grid gap-6 lg:grid-cols-3">
            <x-card>
                <h3 class="font-display mb-4 text-lg font-semibold text-maroon-900">Autentikasi</h3>
                <x-form-input label="Nama Lengkap (Sesuai KTP)" name="name" :value="old('name', $member->user->name)" placeholder="Nama Lengkap" />

                <div>
                    <x-form-input label="Email" name="email" type="email" :value="old('email', $member->user->email)" placeholder="Email" />
                    <p id="email-availability" class="-mt-3 mb-3 text-xs"></p>
                </div>
                <div>
                    <x-form-input label="Username" name="username" :value="old('username', $member->user->username)" placeholder="Username" />
                    <p id="username-availability" class="-mt-3 mb-3 text-xs"></p>
                </div>

                <x-form-input label="Nomor Ponsel" name="phone_number" :value="old('phone_number', $member->user->phone_number)" placeholder="Nomor Ponsel" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                    <div class="flex items-center gap-4">
                        <img src="{{ $member->user->photo ? asset('storage/' . $member->user->photo) : '' }}" class="img-preview h-16 w-16 rounded-full border border-cream-200 object-cover">
                        <input type="file" id="photo" name="photo"
                            class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    </div>
                    @error('photo')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Kata Sandi Baru" name="password" type="password" placeholder="Kata Sandi Saat Ini" />
                <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />
            </x-card>

            <x-card>
                <h3 class="font-display mb-4 text-lg font-semibold text-maroon-900">Biodata Member</h3>
                <x-form-input label="Nomor KTP" name="nomor_ktp" type="number" :value="old('nomor_ktp', $member->nomor_ktp)" placeholder="Nomor KTP" />
                <x-form-input label="Nama Sesuai Paspor" name="nama_sesuai_paspor" :value="old('nama_sesuai_paspor', $member->nama_sesuai_paspor)" placeholder="Nama Sesuai Paspor" />
                <x-form-input label="Kota Tempat Lahir" name="tempat_lahir" :value="old('tempat_lahir', $member->tempat_lahir)" placeholder="Kota Tempat Lahir" />
                <x-form-input label="Tanggal Lahir" name="tanggal_lahir" type="date" :value="old('tanggal_lahir', $member->tanggal_lahir)" />

                <div class="mb-4">
                    <label for="jenis_kelamin" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" @selected(old('jenis_kelamin', $member->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('jenis_kelamin', $member->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Golongan Darah</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach (['A', 'B', 'AB', 'O'] as $goldar)
                            <label class="flex items-center gap-1.5 text-sm text-stone-700">
                                <input type="radio" name="golongan_darah" value="{{ $goldar }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('golongan_darah', $member->golongan_darah) == $goldar)> {{ $goldar }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Kewarganegaraan</label>
                    <div class="flex gap-4">
                        @foreach (['WNI', 'WNA'] as $kwn)
                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                <input type="radio" name="kewarganegaraan" value="{{ $kwn }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('kewarganegaraan', $member->kewarganegaraan) == $kwn)> {{ $kwn }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label for="provinsi_id" class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                    <select id="provinsi_id" name="provinsi_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Provinsi</option>
                        @foreach ($provinsis as $provinsi)
                            <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id', $member->provinsi_id))>{{ $provinsi->provinsi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="kabupaten_id" class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                    <select id="kabupaten_id" name="kabupaten_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Kabupaten</option>
                        @foreach ($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == old('kabupaten_id', $member->kabupaten_id))>{{ $kabupaten->kabupaten }}</option>
                        @endforeach
                    </select>
                </div>

                <x-form-input label="Kecamatan" name="kecamatan" :value="old('kecamatan', $member->kecamatan)" placeholder="Kecamatan" />
                <x-form-input label="Desa / Kelurahan" name="kelurahan" :value="old('kelurahan', $member->kelurahan)" placeholder="Desa / Kelurahan" />
                <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="old('kode_pos', $member->kode_pos)" placeholder="Kode Pos" />
                <x-form-textarea label="Detail Alamat" name="alamat" :value="old('alamat', $member->alamat)" placeholder="Detail Alamat" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Tingkat Pendidikan</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ([
                            'SD' => 'SD/MI/Sederajat', 'SLTP' => 'SLTP/SMP/MTs/Sederajat', 'SLTA' => 'SLTA/SMA/MA/Sederajat',
                            'D1/D2/D3' => 'D1/D2/D3', 'D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3',
                        ] as $value => $label)
                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                <input type="radio" name="tingkat_pendidikan" value="{{ $value }}" class="text-maroon-700 focus:ring-maroon-400" @checked(old('tingkat_pendidikan', $member->tingkat_pendidikan) == $value)> {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <x-form-input label="Pekerjaan" name="pekerjaan" :value="old('pekerjaan', $member->pekerjaan)" placeholder="Pekerjaan" />
            </x-card>

            <x-card>
                <h3 class="font-display mb-4 text-lg font-semibold text-maroon-900">Data Paspor</h3>
                <x-form-input label="Nomor Paspor" name="nomor_paspor" :value="old('nomor_paspor', $member->nomor_paspor)" placeholder="Nomor Paspor" />
                <x-form-input label="Tempat Dikeluarkan (Kota/Kabupaten)" name="tempat_dikeluarkan" :value="old('tempat_dikeluarkan', $member->tempat_dikeluarkan)" placeholder="Tempat Dikeluarkan" />
                <x-form-input label="Tanggal Dikeluarkan" name="tanggal_dikeluarkan" type="date" :value="old('tanggal_dikeluarkan', $member->tanggal_dikeluarkan)" />
                <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="old('tanggal_kadaluarsa', $member->tanggal_kadaluarsa)" />

                <h3 class="font-display mb-4 mt-6 text-lg font-semibold text-maroon-900">Data Lainnya</h3>
                <div class="mb-4 flex flex-wrap gap-4">
                    <label class="flex items-center gap-2 text-sm text-stone-700">
                        <input type="checkbox" value="1" name="pernah_umroh" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('pernah_umroh', $member->pernah_umroh))>
                        Pernah Umroh?
                    </label>
                    <label class="flex items-center gap-2 text-sm text-stone-700">
                        <input type="checkbox" value="1" name="pernah_haji" class="rounded text-maroon-700 focus:ring-maroon-400" @checked(old('pernah_haji', $member->pernah_haji))>
                        Pernah Haji?
                    </label>
                </div>

                <x-form-input label="Nama Keluarga Terdekat" name="nama_keluarga_terdekat" :value="old('nama_keluarga_terdekat', $member->nama_keluarga_terdekat)" placeholder="Nama Keluarga Terdekat" />
                <x-form-input label="Kontak Keluarga Terdekat" name="kontak_keluarga_terdekat" :value="old('kontak_keluarga_terdekat', $member->kontak_keluarga_terdekat)" placeholder="Kontak Keluarga Terdekat" />
            </x-card>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <x-button variant="secondary" href="/admin/member">Kembali</x-button>
            <x-button type="submit">Simpan</x-button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('photo').addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
                reader.readAsDataURL(file);
            });

            document.getElementById('provinsi_id').addEventListener('change', function () {
                fetch('/get-kabupaten', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ provinsi_id: this.value }),
                })
                    .then(response => response.json())
                    .then(data => {
                        const kabupatenSelect = document.getElementById('kabupaten_id');
                        kabupatenSelect.innerHTML = '<option value="" selected disabled>Pilih Kabupaten</option>';
                        data.forEach(kabupaten => {
                            const option = document.createElement('option');
                            option.value = kabupaten.id;
                            option.textContent = kabupaten.kabupaten;
                            kabupatenSelect.appendChild(option);
                        });
                    });
            });
        });
    </script>
@endsection
