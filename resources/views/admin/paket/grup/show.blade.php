@extends('admin.layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <x-page-header :title="$title">
        <x-slot:actions>
            <a href="/admin/paket/{{ $grup->paket_id }}/jemaah?grup_id={{ $grup->id }}" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-show"></i> Jema'ah</a>
            <a href="/admin/grup/{{ $grup->id }}/isu-perjalanan" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-error-circle"></i> Isu Perjalanan</a>
            <a href="/admin/grup/{{ $grup->id }}/jadwal" class="inline-flex items-center gap-1.5 rounded-lg border border-cream-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-cream-50"><i class="bx bx-calendar"></i> Jadwal</a>
            <x-button variant="secondary" :href="'/admin/paket/' . $grup->paket_id . '/grup'"><i class="bx bx-arrow-back"></i> Kembali</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-card class="mb-6">
        <div class="flex flex-col gap-6 md:flex-row md:items-start">
            <img src="{{ asset('storage/' . $grup->paket->gambar) }}" class="h-40 w-32 shrink-0 rounded-lg object-cover" alt="grup">
            <div class="grid flex-1 gap-6 md:grid-cols-2">
                <ul class="space-y-1.5 text-sm text-stone-700">
                    <li><span class="text-stone-500">Nama Paket:</span> {{ $grup->paket->nama_paket }}</li>
                    <li><span class="text-stone-500">Nama Grup:</span> {{ $grup->nama_grup }}</li>
                    <li><span class="text-stone-500">Nama Agen:</span> {{ $grup->agen->user->name ?? '' }}</li>
                    <li><span class="text-stone-500">Ketua Grup:</span> {{ $grup->ketua_grup }}</li>
                    <li>
                        <span class="text-stone-500">Kuota Grup:</span>
                        @if ($grup->kuota_grup !== null)
                            <x-badge :variant="$anggotas->count() >= $grup->kuota_grup ? 'danger' : 'success'">{{ $anggotas->count() }} / {{ $grup->kuota_grup }} terisi</x-badge>
                        @else
                            <x-badge variant="info">Tidak dibatasi</x-badge>
                        @endif
                    </li>
                    <li><span class="text-stone-500">Status Grup:</span> {{ $grup->status_grup }}</li>
                    <li><span class="text-stone-500">Keterangan Grup:</span> {{ $grup->keterangan_grup }}</li>
                </ul>
                <div class="flex flex-col items-start gap-2">
                    <a href="/admin/paket/{{ $grup->paket_id }}/jemaah?grup_id={{ $grup->id }}" class="inline-flex items-center gap-1.5 rounded-md bg-maroon-50 px-3 py-1.5 text-xs font-medium text-maroon-700 hover:bg-maroon-100"><i class="bx bx-show"></i> Lihat Data Jema'ah</a>
                    <a href="/admin/grup/{{ $grup->id }}/tagihan" class="inline-flex items-center gap-1.5 rounded-md bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700 hover:bg-emerald-100"><i class="bx bx-file"></i> Lihat Tagihan Grup</a>
                </div>
            </div>
        </div>
    </x-card>

    <div x-data="modalForm()">
        <x-card class="mb-6">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Isu Perjalanan</h4>
                <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Buat Isu
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Masalah</th>
                            <th class="px-3 py-2">Solusi</th>
                            <th class="px-3 py-2">Waktu Pelaporan</th>
                            <th class="px-3 py-2">Waktu Penyelesaian</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($grup->IsuPerjalanans as $isu)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $isu->masalah }}</td>
                                <td class="px-3 py-2">{{ $isu->solusi }}</td>
                                <td class="px-3 py-2">{{ Carbon::parse($isu->waktu_pelaporan)->isoFormat('LLL') }}</td>
                                <td class="px-3 py-2">{{ Carbon::parse($isu->waktu_penyelesaian)->isoFormat('LLL') }}</td>
                                <td class="px-3 py-2"><x-badge :variant="$isu->status ? 'warning' : 'success'">{{ $isu->status ? 'Dalam Penanganan' : 'Sudah Selesai' }}</x-badge></td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2" x-data="modalForm()">
                                        <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                        <x-delete-form :action="'/admin/isu-perjalanan/' . $isu->id" />

                                        <x-modal title="Edit Isu Perjalanan" maxWidth="max-w-3xl">
                                            <form action="/admin/isu-perjalanan/{{ $isu->id }}" method="post" @submit="submit">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="grup_id" value="{{ $isu->grup_id }}">

                                                <div class="grid gap-x-6 md:grid-cols-2">
                                                    <div>
                                                        <x-form-input label="Masalah" name="masalah" :value="$isu->masalah" placeholder="Masalah" required />
                                                        <x-form-error name="masalah" />
                                                        <x-form-input label="Solusi" name="solusi" :value="$isu->solusi" placeholder="Solusi" />
                                                        <x-form-error name="solusi" />
                                                    </div>
                                                    <div>
                                                        <x-form-input label="Waktu Pelaporan" name="waktu_pelaporan" type="datetime-local" :value="$isu->waktu_pelaporan" />
                                                        <x-form-input label="Waktu Penyelesaian" name="waktu_penyelesaian" type="datetime-local" :value="$isu->waktu_penyelesaian" />
                                                        <div class="mb-4">
                                                            <label class="inline-flex items-center gap-2 text-sm font-medium text-stone-700">
                                                                <input type="checkbox" value="1" name="status" class="rounded border-cream-300 text-maroon-700 focus:ring-maroon-300" @checked($isu->status)>
                                                                Dalam Penanganan?
                                                            </label>
                                                            <x-form-error name="status" />
                                                        </div>
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
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-2 text-stone-500">Isu Perjalanan belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-modal title="Buat Isu Perjalanan" maxWidth="max-w-3xl">
            <form action="/admin/isu-perjalanan" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="grup_id" value="{{ $grup->id }}">

                <div class="grid gap-x-6 md:grid-cols-2">
                    <div>
                        <x-form-input label="Masalah" name="masalah" placeholder="Masalah" required />
                        <x-form-error name="masalah" />
                        <x-form-input label="Solusi" name="solusi" placeholder="Solusi" />
                        <x-form-error name="solusi" />
                    </div>
                    <div>
                        <x-form-input label="Waktu Pelaporan" name="waktu_pelaporan" type="datetime-local" />
                        <x-form-input label="Waktu Penyelesaian" name="waktu_penyelesaian" type="datetime-local" />
                        <div class="mb-4">
                            <label class="inline-flex items-center gap-2 text-sm font-medium text-stone-700">
                                <input type="checkbox" value="1" name="status" class="rounded border-cream-300 text-maroon-700 focus:ring-maroon-300">
                                Dalam Penanganan?
                            </label>
                            <x-form-error name="status" />
                        </div>
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

    <div x-data="modalForm()">
        <x-card class="mb-6">
            <div class="mb-3 flex items-center justify-between">
                <h4 class="font-display text-sm font-semibold text-maroon-900">Jadwal</h4>
                <button type="button" @click="show()" class="inline-flex items-center gap-1 rounded-lg bg-maroon-700 px-3 py-1.5 text-xs font-medium text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah Jadwal
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Nama Agenda</th>
                            <th class="px-3 py-2">Lokasi</th>
                            <th class="px-3 py-2">Waktu Mulai</th>
                            <th class="px-3 py-2">Waktu Selesai</th>
                            <th class="px-3 py-2">Keterangan</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        @forelse ($grup->jadwals as $jadwal)
                            <tr>
                                <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $jadwal->nama_agenda }}</td>
                                <td class="px-3 py-2">{{ $jadwal->lokasi }}</td>
                                <td class="px-3 py-2">{{ Carbon::parse($jadwal->waktu_mulai)->isoFormat('LLL') }}</td>
                                <td class="px-3 py-2">{{ Carbon::parse($jadwal->waktu_selesai)->isoFormat('LLL') }}</td>
                                <td class="px-3 py-2">{{ $jadwal->keterangan }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center gap-2" x-data="modalForm()">
                                        <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                        <x-delete-form :action="'/admin/jadwal/' . $jadwal->id" />

                                        <x-modal title="Edit Jadwal" maxWidth="max-w-3xl">
                                            <form action="/admin/jadwal/{{ $jadwal->id }}" method="post" @submit="submit">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="grup_id" value="{{ $jadwal->grup_id }}">

                                                <div class="grid gap-x-6 md:grid-cols-2">
                                                    <div>
                                                        <x-form-input label="Nama Agenda" name="nama_agenda" :value="$jadwal->nama_agenda" placeholder="Nama Agenda" required />
                                                        <x-form-error name="nama_agenda" />
                                                        <x-form-input label="Lokasi" name="lokasi" :value="$jadwal->lokasi" placeholder="Lokasi" />
                                                        <x-form-error name="lokasi" />
                                                    </div>
                                                    <div>
                                                        <x-form-input label="Waktu Mulai" name="waktu_mulai" type="datetime-local" :value="$jadwal->waktu_mulai" />
                                                        <x-form-input label="Waktu Selesai" name="waktu_selesai" type="datetime-local" :value="$jadwal->waktu_selesai" />
                                                        <x-form-textarea label="Keterangan" name="keterangan" :value="$jadwal->keterangan" placeholder="Keterangan" />
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
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-2 text-stone-500">Jadwal belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-modal title="Tambah Jadwal" maxWidth="max-w-3xl">
            <form action="/admin/jadwal" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="grup_id" value="{{ $grup->id }}">

                <div class="grid gap-x-6 md:grid-cols-2">
                    <div>
                        <x-form-input label="Nama Agenda" name="nama_agenda" placeholder="Nama Agenda" required />
                        <x-form-error name="nama_agenda" />
                        <x-form-input label="Lokasi" name="lokasi" placeholder="Lokasi" />
                        <x-form-error name="lokasi" />
                    </div>
                    <div>
                        <x-form-input label="Waktu Mulai" name="waktu_mulai" type="datetime-local" />
                        <x-form-input label="Waktu Selesai" name="waktu_selesai" type="datetime-local" />
                        <x-form-textarea label="Keterangan" name="keterangan" placeholder="Keterangan" />
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

    <x-card>
        <h4 class="font-display mb-4 text-sm font-semibold text-maroon-900">Masukkan Jema'ah</h4>
        <div class="grid items-start gap-4 md:grid-cols-[1fr_auto_1fr]">
            <div>
                <h6 class="mb-2 text-sm font-semibold text-stone-700">Data Jema'ah</h6>
                <div class="overflow-x-auto rounded-lg border border-cream-200">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">Nama Lengkap</th>
                                <th class="px-3 py-2">Pilih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse ($jemaahs as $jemaah)
                                <tr>
                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2">{{ $jemaah->nama_lengkap }}</td>
                                    <td class="px-3 py-2">
                                        <input type="checkbox" value="{{ $jemaah->id }}" name="jemaah_ids[]">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-3 py-2 text-stone-500">Jema'ah tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center gap-2 py-4 md:flex-col">
                <button type="button" id="pindah-ke-grup" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-maroon-50 text-maroon-700 hover:bg-maroon-100">
                    <i class="bx bx-right-arrow-alt text-lg"></i>
                </button>
                <button type="button" id="kembali-ke-jemaah" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-maroon-50 text-maroon-700 hover:bg-maroon-100">
                    <i class="bx bx-left-arrow-alt text-lg"></i>
                </button>
            </div>
            <div>
                <h6 class="mb-2 text-sm font-semibold text-stone-700">Data Anggota Grup</h6>
                <div class="overflow-x-auto rounded-lg border border-cream-200">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                            <tr>
                                <th class="px-3 py-2">#</th>
                                <th class="px-3 py-2">Nama Lengkap</th>
                                <th class="px-3 py-2">Pilih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200">
                            @forelse ($anggotas as $anggota)
                                <tr>
                                    <td class="px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2">{{ $anggota->nama_lengkap }}</td>
                                    <td class="px-3 py-2">
                                        <input type="checkbox" value="{{ $anggota->id }}" name="anggota_ids[]">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-3 py-2 text-stone-500">Anggota tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-card>
@endsection

@section('script')
    <script>
        document.getElementById('pindah-ke-grup').addEventListener('click', function () {
            const jemaahIds = Array.from(document.querySelectorAll('input[name="jemaah_ids[]"]:checked')).map(cb => cb.value);

            fetch('{{ route('admin.grup.pindah-ke-grup') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ jemaah_ids: jemaahIds, grup_id: {{ $grup->id }} }),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(() => alert('Terjadi kesalahan saat memindahkan data ke grup.'));
        });

        document.getElementById('kembali-ke-jemaah').addEventListener('click', function () {
            const anggotaIds = Array.from(document.querySelectorAll('input[name="anggota_ids[]"]:checked')).map(cb => cb.value);

            fetch('{{ route('admin.grup.kembali-ke-jemaah') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ anggota_ids: anggotaIds }),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(() => alert('Terjadi kesalahan saat mengembalikan data ke jemaah.'));
        });
    </script>
@endsection
