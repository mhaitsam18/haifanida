@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
                @if ($pemesanan)
                    <x-button variant="secondary" :href="'/admin/pemesanan/' . $pemesanan->id"><i class="bx bx-arrow-back"></i> Kembali</x-button>
                @endif
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Pemesanan Kamar">
            <form class="js-pemesanan-kamar-form" action="/admin/pemesanan-kamar" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id ?? null }}">

                <div class="mb-4">
                    <label for="tipe_kamar" class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                    <select id="tipe_kamar" name="tipe_kamar" class="js-tipe-kamar-select w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Tipe Kamar</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->nama_ekstra }}" data-harga="{{ $kamar->harga_default }}" data-keterangan="{{ $kamar->keterangan }}">
                                {{ $kamar->nama_ekstra }} | Rp.{{ number_format($kamar->harga_default, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <x-form-error name="tipe_kamar" />
                </div>

                <x-form-input label="Jumlah Pengisi" name="jumlah_pengisi" type="number" class="js-jumlah-pengisi-input" placeholder="Jumlah Pengisi" max="4" />
                <x-form-error name="jumlah_pengisi" />
                <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                <x-form-input label="Harga" name="harga" type="number" class="js-harga-input" placeholder="Total Harga" />
                <x-form-error name="harga" />

                <x-form-textarea label="Keterangan" name="keterangan" placeholder="Keterangan" />
                <x-form-error name="keterangan" />

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

    <x-data-table searchPlaceholder="Cari pemesanan kamar...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Tipe Kamar</th>
                    <th class="px-4 py-3">Jumlah Pengisi</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pemesananKamars as $kamar)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $kamar->tipe_kamar }}</td>
                        <td class="px-4 py-3">{{ $kamar->jumlah_pengisi }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($kamar->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $kamar->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/pemesanan-kamar/{{ $kamar->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Lihat Permintaan</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/pemesanan-kamar/' . $kamar->id" />

                                <x-modal title="Edit Pemesanan Kamar">
                                    <form class="js-pemesanan-kamar-form" action="/admin/pemesanan-kamar/{{ $kamar->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="pemesanan_id" value="{{ $kamar->pemesanan_id }}">

                                        <div class="mb-4">
                                            <label for="tipe_kamar_{{ $kamar->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                                            <select id="tipe_kamar_{{ $kamar->id }}" name="tipe_kamar" class="js-tipe-kamar-select js-tipe-kamar-select-edit w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Tipe Kamar</option>
                                                @foreach ($kamars as $item)
                                                    <option value="{{ $item->nama_ekstra }}" data-harga="{{ $item->harga_default }}" data-keterangan="{{ $item->keterangan }}" @selected($item->nama_ekstra == $kamar->tipe_kamar)>
                                                        {{ $item->nama_ekstra }} | Rp.{{ number_format($item->harga_default, 2, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="tipe_kamar" />
                                        </div>

                                        <x-form-input label="Jumlah Pengisi" name="jumlah_pengisi" type="number" class="js-jumlah-pengisi-input" :value="$kamar->jumlah_pengisi" placeholder="Jumlah Pengisi" max="4" />
                                        <x-form-error name="jumlah_pengisi" />
                                        <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                                        <x-form-input label="Harga" name="harga" type="number" class="js-harga-input" :value="$kamar->harga" placeholder="Total Harga" />
                                        <x-form-error name="harga" />

                                        <x-form-textarea label="Keterangan" name="keterangan" :value="$kamar->keterangan" placeholder="Keterangan" />
                                        <x-form-error name="keterangan" />

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

@section('script')
    <script>
        (function () {
            const defaultOccupants = {
                'tipe kamar quad gabung': null,
                'tipe kamar quad keluarga': 4,
                'tipe kamar quad keluarga isi 3 dan 1 bed kosong': 3,
                'tipe kamar double gabung': 1,
                'tipe kamar double keluarga': 2,
                'tipe kamar single': 1,
            };

            document.querySelectorAll('.js-pemesanan-kamar-form').forEach(function (form) {
                const tipeKamarSelect = form.querySelector('.js-tipe-kamar-select');
                const jumlahPengisiInput = form.querySelector('.js-jumlah-pengisi-input');
                const hargaInput = form.querySelector('.js-harga-input');
                const keteranganDescription = form.querySelector('.js-keterangan-desc');
                const isEdit = tipeKamarSelect.classList.contains('js-tipe-kamar-select-edit');

                function updatePriceAndDescription() {
                    const selected = tipeKamarSelect.options[tipeKamarSelect.selectedIndex];

                    if (selected && selected.value !== '') {
                        keteranganDescription.textContent = selected.getAttribute('data-keterangan') ?? '';

                        const harga = parseFloat(selected.getAttribute('data-harga'));
                        const jumlah = jumlahPengisiInput.value;
                        if (jumlah !== '' && !isNaN(jumlah)) {
                            hargaInput.value = (harga * parseInt(jumlah)).toFixed(2);
                        } else if (!isEdit) {
                            hargaInput.value = harga.toFixed(2);
                        }
                    } else {
                        keteranganDescription.textContent = '';
                        if (!isEdit) {
                            hargaInput.value = '';
                            jumlahPengisiInput.value = '';
                        }
                    }
                }

                tipeKamarSelect.addEventListener('change', function () {
                    const selected = tipeKamarSelect.options[tipeKamarSelect.selectedIndex];
                    if (selected && Object.prototype.hasOwnProperty.call(defaultOccupants, selected.value)) {
                        const fixedOccupants = defaultOccupants[selected.value];
                        if (fixedOccupants === null) {
                            jumlahPengisiInput.value = '';
                            jumlahPengisiInput.readOnly = false;
                        } else {
                            jumlahPengisiInput.value = fixedOccupants;
                            jumlahPengisiInput.readOnly = true;
                        }
                    } else {
                        jumlahPengisiInput.readOnly = false;
                    }
                    updatePriceAndDescription();
                });
                jumlahPengisiInput.addEventListener('input', updatePriceAndDescription);
            });
        })();
    </script>
@endsection
