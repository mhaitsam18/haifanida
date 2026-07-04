@extends('layouts.app')

@section('content')
    <section class="py-10">
        <div class="mx-auto max-w-2xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Edit Pemesanan Ekstra</h2>
                <p class="mt-1 text-sm text-stone-500">Silakan ubah layanan tambahan yang diinginkan</p>
            </div>

            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif

            <form action="{{ route('pemesanan-ekstra.update', $pemesananEkstra) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="{{ $pemesanan_id }}">

                <x-card>
                    <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                        <i class="bx bx-bell"></i> Data Pemesanan Ekstra
                    </h3>

                    <div class="mb-4">
                        <label for="jenis_ekstra" class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra / Tambahan <span class="text-maroon-700">*</span></label>
                        <select id="jenis_ekstra" name="jenis_ekstra" required
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option disabled value="">Pilih Jenis Ekstra</option>
                            @foreach ($ekstras as $ekstra)
                                <option value="{{ $ekstra->id }}"
                                    data-harga="{{ $ekstra->harga_default }}"
                                    data-keterangan="{{ $ekstra->keterangan ?? $ekstra->deskripsi ?? '' }}"
                                    @selected($ekstra->id == old('jenis_ekstra', $pemesananEkstra->ekstra == $ekstra->nama_ekstra ? $ekstra->id : ''))>
                                    {{ $ekstra->nama_ekstra }} | Rp {{ number_format($ekstra->harga_default, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_ekstra')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        @if ($ekstras->isEmpty())
                            <p class="mt-2 rounded-lg bg-amber-50 px-3 py-2 text-xs text-amber-700">Tidak ada layanan ekstra tersedia.</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="harga_satuan" class="mb-1.5 block text-sm font-medium text-stone-700">Harga Satuan</label>
                        <input type="text" id="harga_satuan" readonly
                            class="w-full rounded-lg border border-cream-300 bg-cream-100 px-3 py-2 text-sm text-stone-600">
                        <input type="hidden" name="harga_satuan" id="harga_satuan_hidden">
                        <p class="mt-1 text-xs text-stone-500">Harga per unit layanan</p>
                    </div>

                    <div class="mb-4">
                        <label for="jumlah" class="mb-1.5 block text-sm font-medium text-stone-700">Jumlah <span class="text-maroon-700">*</span></label>
                        <input type="number" id="jumlah" name="jumlah" min="1" value="{{ old('jumlah', $pemesananEkstra->jumlah) }}" required
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <p id="keterangan_description" class="mt-1 text-xs text-stone-500"></p>
                        @error('jumlah')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="total_harga" class="mb-1.5 block text-sm font-medium text-stone-700">Total Harga <span class="text-maroon-700">*</span></label>
                        <input type="text" id="total_harga" readonly
                            class="w-full rounded-lg border border-cream-300 bg-cream-100 px-3 py-2 text-sm text-stone-600">
                        <input type="hidden" name="total_harga" id="total_harga_hidden" required>
                        @error('total_harga')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-textarea label="Keterangan / Catatan" name="keterangan" :value="$pemesananEkstra->keterangan" :rows="3" placeholder="Masukkan keterangan atau catatan tambahan (opsional)" />
                </x-card>

                <div class="mt-6 flex items-center justify-between">
                    <x-button variant="secondary" :href="route('pemesanan.detail', $pemesanan_id)">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                    <x-button type="submit">
                        <i class="bx bx-save"></i> Simpan Perubahan
                    </x-button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisEkstra = document.getElementById('jenis_ekstra');
            const jumlah = document.getElementById('jumlah');

            function updatePriceAndDescription() {
                const selectedOption = jenisEkstra.options[jenisEkstra.selectedIndex];
                const hargaSatuan = parseFloat(selectedOption?.getAttribute('data-harga'));
                const keterangan = selectedOption?.getAttribute('data-keterangan');

                if (jenisEkstra.value !== '') {
                    document.getElementById('harga_satuan').value = hargaSatuan ? 'Rp ' + hargaSatuan.toLocaleString('id-ID') : '';
                    document.getElementById('harga_satuan_hidden').value = hargaSatuan || '';
                    document.getElementById('keterangan_description').textContent = keterangan || '';
                } else {
                    document.getElementById('harga_satuan').value = '';
                    document.getElementById('harga_satuan_hidden').value = '';
                    document.getElementById('keterangan_description').textContent = '';
                    document.getElementById('total_harga').value = '';
                    document.getElementById('total_harga_hidden').value = '';
                    return;
                }

                const numberOfItems = parseInt(jumlah.value, 10);
                if (numberOfItems > 0) {
                    const totalPrice = hargaSatuan * numberOfItems;
                    document.getElementById('total_harga').value = totalPrice ? 'Rp ' + totalPrice.toLocaleString('id-ID') : '';
                    document.getElementById('total_harga_hidden').value = totalPrice || '';
                } else {
                    document.getElementById('total_harga').value = '';
                    document.getElementById('total_harga_hidden').value = '';
                }
            }

            jenisEkstra.addEventListener('change', updatePriceAndDescription);
            jumlah.addEventListener('input', updatePriceAndDescription);
            updatePriceAndDescription();
        });
    </script>
@endsection
