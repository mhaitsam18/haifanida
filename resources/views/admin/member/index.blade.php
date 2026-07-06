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

        <x-modal title="Tambah Member" maxWidth="max-w-2xl">
            <form action="/admin/member" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <x-form-input label="Nama Lengkap (Sesuai KTP)" name="name" placeholder="Nama Lengkap" />
                <x-form-error name="name" />

                <div class="avail-wrap">
                    <x-form-input label="Email" name="email" type="email" placeholder="Email" class="js-check-email" />
                    <p class="availability-result -mt-3 mb-3 text-xs"></p>
                </div>
                <x-form-error name="email" />

                <div class="avail-wrap">
                    <x-form-input label="Username" name="username" placeholder="Username" class="js-check-username" />
                    <p class="availability-result -mt-3 mb-3 text-xs"></p>
                </div>
                <x-form-error name="username" />

                <x-form-input label="Nomor Ponsel" name="phone_number" placeholder="Nomor Ponsel" />
                <x-form-error name="phone_number" />

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                    <div class="flex items-center gap-4">
                        <img x-show="previewUrl" :src="previewUrl" class="h-16 w-16 rounded-full border border-cream-200 object-cover">
                        <input type="file" name="photo" @change="preview($event)"
                            class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    </div>
                    <x-form-error name="photo" />
                </div>

                <x-form-input label="Kata Sandi" name="password" type="password" placeholder="Kata Sandi" />
                <x-form-error name="password" />
                <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />

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

    <x-data-table searchPlaceholder="Cari member...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Nomor Ponsel</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($members as $member)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $member->user->name }}</td>
                        <td class="px-4 py-3">{{ $member->user->email }}</td>
                        <td class="px-4 py-3">{{ $member->user->username }}</td>
                        <td class="px-4 py-3">{{ $member->user->phone_number }}</td>
                        <td class="px-4 py-3">
                            @if ($member->user->photo)
                                <img src="{{ asset('storage/' . $member->user->photo) }}" alt="Foto" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Detail</button>
                                <x-delete-form :action="'/admin/member/' . $member->id" />

                                <x-modal title="Edit Member" maxWidth="max-w-6xl">
                                    <form action="/admin/member/{{ $member->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf

                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <x-card title="Autentikasi">
                                                <x-form-input label="Nama Lengkap (Sesuai KTP)" name="name" :value="$member->user->name" placeholder="Nama Lengkap" />
                                                <x-form-error name="name" />

                                                <div class="avail-wrap">
                                                    <x-form-input label="Email" name="email" type="email" :value="$member->user->email" placeholder="Email" class="js-check-email" />
                                                    <p class="availability-result -mt-3 mb-3 text-xs"></p>
                                                </div>
                                                <x-form-error name="email" />

                                                <div class="avail-wrap">
                                                    <x-form-input label="Username" name="username" :value="$member->user->username" placeholder="Username" class="js-check-username" />
                                                    <p class="availability-result -mt-3 mb-3 text-xs"></p>
                                                </div>
                                                <x-form-error name="username" />

                                                <x-form-input label="Nomor Ponsel" name="phone_number" :value="$member->user->phone_number" placeholder="Nomor Ponsel" />
                                                <x-form-error name="phone_number" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                                                    <div class="flex items-center gap-4">
                                                        <img :src="previewUrl || '{{ $member->user->photo ? asset('storage/' . $member->user->photo) : '' }}'" class="h-16 w-16 rounded-full border border-cream-200 object-cover">
                                                        <input type="file" name="photo" @change="preview($event)"
                                                            class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    </div>
                                                    <x-form-error name="photo" />
                                                </div>

                                                <x-form-input label="Kata Sandi Baru" name="password" type="password" placeholder="Kata Sandi Baru" />
                                                <x-form-error name="password" />
                                                <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />
                                            </x-card>

                                            <x-card title="Biodata Member">
                                                <x-form-input label="Nomor KTP" name="nomor_ktp" type="number" :value="$member->nomor_ktp" placeholder="Nomor KTP" />
                                                <x-form-input label="Nama Sesuai Paspor" name="nama_sesuai_paspor" :value="$member->nama_sesuai_paspor" placeholder="Nama Sesuai Paspor" />
                                                <x-form-input label="Kota Tempat Lahir" name="tempat_lahir" :value="$member->tempat_lahir" placeholder="Kota Tempat Lahir" />
                                                <x-form-input label="Tanggal Lahir" name="tanggal_lahir" type="date" :value="$member->tanggal_lahir" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                        <option value="Laki-laki" @selected($member->jenis_kelamin == 'Laki-laki')>Laki-laki</option>
                                                        <option value="Perempuan" @selected($member->jenis_kelamin == 'Perempuan')>Perempuan</option>
                                                    </select>
                                                    <x-form-error name="jenis_kelamin" />
                                                </div>

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Golongan Darah</label>
                                                    <div class="flex flex-wrap gap-3">
                                                        @foreach (['A', 'B', 'AB', 'O'] as $goldar)
                                                            <label class="flex items-center gap-1.5 text-sm text-stone-700">
                                                                <input type="radio" name="golongan_darah" value="{{ $goldar }}" class="text-maroon-700 focus:ring-maroon-400" @checked($member->golongan_darah == $goldar)> {{ $goldar }}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Kewarganegaraan</label>
                                                    <div class="flex gap-4">
                                                        @foreach (['WNI', 'WNA'] as $kwn)
                                                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                                                <input type="radio" name="kewarganegaraan" value="{{ $kwn }}" class="text-maroon-700 focus:ring-maroon-400" @checked($member->kewarganegaraan == $kwn)> {{ $kwn }}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                                                    <select name="provinsi_id" x-ref="provinsiEdit{{ $member->id }}" @change="loadKabupaten($event, $refs['kabupatenEdit{{ $member->id }}'])"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Provinsi</option>
                                                        @foreach ($provinsis as $provinsi)
                                                            <option value="{{ $provinsi->id }}" @selected($provinsi->id == $member->provinsi_id)>{{ $provinsi->provinsi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="provinsi_id" />
                                                </div>

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                                                    <select name="kabupaten_id" x-ref="kabupatenEdit{{ $member->id }}"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Kabupaten</option>
                                                        @foreach ($kabupatens as $kabupaten)
                                                            <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == $member->kabupaten_id)>{{ $kabupaten->kabupaten }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="kabupaten_id" />
                                                </div>

                                                <x-form-input label="Kecamatan" name="kecamatan" :value="$member->kecamatan" placeholder="Kecamatan" />
                                                <x-form-input label="Desa / Kelurahan" name="kelurahan" :value="$member->kelurahan" placeholder="Desa / Kelurahan" />
                                                <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="$member->kode_pos" placeholder="Kode Pos" />
                                                <x-form-textarea label="Detail Alamat" name="alamat" :value="$member->alamat" placeholder="Detail Alamat" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Tingkat Pendidikan</label>
                                                    <div class="grid grid-cols-2 gap-2">
                                                        @foreach ([
                                                            'SD' => 'SD/MI/Sederajat', 'SLTP' => 'SLTP/SMP/MTs/Sederajat', 'SLTA' => 'SLTA/SMA/MA/Sederajat',
                                                            'D1/D2/D3' => 'D1/D2/D3', 'D4/S1' => 'D4/S1', 'S2' => 'S2', 'S3' => 'S3',
                                                        ] as $value => $label)
                                                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                                                <input type="radio" name="tingkat_pendidikan" value="{{ $value }}" class="text-maroon-700 focus:ring-maroon-400" @checked($member->tingkat_pendidikan == $value)> {{ $label }}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <x-form-input label="Pekerjaan" name="pekerjaan" :value="$member->pekerjaan" placeholder="Pekerjaan" />
                                            </x-card>

                                            <x-card title="Data Paspor">
                                                <x-form-input label="Nomor Paspor" name="nomor_paspor" :value="$member->nomor_paspor" placeholder="Nomor Paspor" />
                                                <x-form-input label="Tempat Dikeluarkan (Kota/Kabupaten)" name="tempat_dikeluarkan" :value="$member->tempat_dikeluarkan" placeholder="Tempat Dikeluarkan" />
                                                <x-form-input label="Tanggal Dikeluarkan" name="tanggal_dikeluarkan" type="date" :value="$member->tanggal_dikeluarkan" />
                                                <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="$member->tanggal_kadaluarsa" />

                                                <h3 class="font-display mb-4 mt-6 text-lg font-semibold text-maroon-900">Data Lainnya</h3>
                                                <div class="mb-4 flex flex-wrap gap-4">
                                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                                        <input type="checkbox" value="1" name="pernah_umroh" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($member->pernah_umroh)>
                                                        Pernah Umroh?
                                                    </label>
                                                    <label class="flex items-center gap-2 text-sm text-stone-700">
                                                        <input type="checkbox" value="1" name="pernah_haji" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($member->pernah_haji)>
                                                        Pernah Haji?
                                                    </label>
                                                </div>

                                                <x-form-input label="Nama Keluarga Terdekat" name="nama_keluarga_terdekat" :value="$member->nama_keluarga_terdekat" placeholder="Nama Keluarga Terdekat" />
                                                <x-form-input label="Kontak Keluarga Terdekat" name="kontak_keluarga_terdekat" :value="$member->kontak_keluarga_terdekat" placeholder="Kontak Keluarga Terdekat" />
                                            </x-card>
                                        </div>

                                        <div class="mt-6 flex justify-end gap-2">
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

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function checkAvailability(input, urlPrefix, label) {
                if (!input.value) return;
                const wrap = input.closest('.avail-wrap');
                const resultEl = wrap ? wrap.querySelector('.availability-result') : null;
                fetch(urlPrefix + '/' + encodeURIComponent(input.value), { headers: { 'Accept': 'application/json' } })
                    .then(response => response.json())
                    .then(data => {
                        if (!resultEl) return;
                        const available = data.status === 'available';
                        resultEl.textContent = available ? label + ' tersedia' : label + ' sudah digunakan';
                        resultEl.style.color = available ? '#15803d' : '#dc2626';
                    });
            }

            document.addEventListener('input', function (e) {
                if (e.target.matches('.js-check-username')) {
                    checkAvailability(e.target, '/check-username', 'Username');
                }
                if (e.target.matches('.js-check-email')) {
                    checkAvailability(e.target, '/check-email', 'Email');
                }
            });
        });
    </script>
@endsection
