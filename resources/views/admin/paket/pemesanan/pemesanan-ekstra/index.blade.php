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

        <x-modal title="Tambah Pemesanan Ekstra">
            <form class="js-pemesanan-ekstra-form" action="/admin/pemesanan-ekstra" method="post" @submit="submit">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id ?? null }}">

                <div class="mb-4">
                    <label for="ekstra" class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra / Tambahan</label>
                    <select id="ekstra" name="ekstra" class="js-ekstra-select w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Ekstra</option>
                        @foreach ($ekstras as $ekstra)
                            <option value="{{ $ekstra->nama_ekstra }}" data-harga="{{ $ekstra->harga_default }}" data-keterangan="{{ $ekstra->keterangan }}">
                                {{ $ekstra->nama_ekstra }} | Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <x-form-error name="ekstra" />
                </div>

                <x-form-input label="Jumlah" name="jumlah" type="number" class="js-jumlah-input" placeholder="Jumlah" />
                <x-form-error name="jumlah" />
                <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                <x-form-input label="Total Harga" name="total_harga" type="number" class="js-total-harga-input" placeholder="Total Harga" />
                <x-form-error name="total_harga" />

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

    <x-data-table searchPlaceholder="Cari pemesanan ekstra...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Ekstra / Tambahan</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Total Harga</th>
                    <th class="px-4 py-3">Keterangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pemesananEkstras as $ekstra)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $ekstra->ekstra }}</td>
                        <td class="px-4 py-3">{{ $ekstra->jumlah }}</td>
                        <td class="px-4 py-3">Rp.{{ number_format($ekstra->total_harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $ekstra->keterangan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/pemesanan-ekstra/' . $ekstra->id" />

                                <x-modal title="Edit Pemesanan Ekstra">
                                    <form class="js-pemesanan-ekstra-form" action="/admin/pemesanan-ekstra/{{ $ekstra->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="pemesanan_id" value="{{ $ekstra->pemesanan_id }}">

                                        <div class="mb-4">
                                            <label for="ekstra_{{ $ekstra->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra / Tambahan</label>
                                            <select id="ekstra_{{ $ekstra->id }}" name="ekstra" class="js-ekstra-select w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                <option value="" selected disabled>Pilih Ekstra</option>
                                                @foreach ($ekstras as $item)
                                                    <option value="{{ $item->nama_ekstra }}" data-harga="{{ $item->harga_default }}" data-keterangan="{{ $item->keterangan }}" @selected($item->nama_ekstra == $ekstra->ekstra)>
                                                        {{ $item->nama_ekstra }} | Rp.{{ number_format($item->harga_default, 2, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-form-error name="ekstra" />
                                        </div>

                                        <x-form-input label="Jumlah" name="jumlah" type="number" class="js-jumlah-input" :value="$ekstra->jumlah" placeholder="Jumlah" />
                                        <x-form-error name="jumlah" />
                                        <p class="js-keterangan-desc -mt-3 mb-4 text-xs text-stone-500"></p>

                                        <x-form-input label="Total Harga" name="total_harga" type="number" class="js-total-harga-input" :value="$ekstra->total_harga" placeholder="Total Harga" />
                                        <x-form-error name="total_harga" />

                                        <x-form-textarea label="Keterangan" name="keterangan" :value="$ekstra->keterangan" placeholder="Keterangan" />
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
            document.querySelectorAll('.js-pemesanan-ekstra-form').forEach(function (form) {
                const ekstraSelect = form.querySelector('.js-ekstra-select');
                const jumlahInput = form.querySelector('.js-jumlah-input');
                const totalHargaInput = form.querySelector('.js-total-harga-input');
                const keteranganDescription = form.querySelector('.js-keterangan-desc');

                function updatePriceAndDescription() {
                    const selected = ekstraSelect.options[ekstraSelect.selectedIndex];
                    const jumlah = jumlahInput.value;

                    if (selected && selected.value !== '') {
                        keteranganDescription.textContent = selected.getAttribute('data-keterangan') ?? '';
                        if (jumlah !== '') {
                            const harga = parseFloat(selected.getAttribute('data-harga'));
                            totalHargaInput.value = harga * parseInt(jumlah);
                        }
                    } else {
                        keteranganDescription.textContent = '';
                        totalHargaInput.value = '';
                    }
                }

                ekstraSelect.addEventListener('change', updatePriceAndDescription);
                jumlahInput.addEventListener('input', updatePriceAndDescription);
            });
        })();
    </script>
@endsection
