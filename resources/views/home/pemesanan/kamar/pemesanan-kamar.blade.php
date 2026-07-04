@extends('layouts.app')

@section('content')
    <section class="py-10">
        <div class="mx-auto max-w-2xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">{{ $title }}</h2>
                <p class="mt-1 text-sm text-stone-500">Silakan isi informasi pemesanan kamar dengan benar</p>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif

            <form action="{{ route('pemesanan.kamar.store') }}" method="POST" id="pemesananKamarForm">
                @csrf

                <x-card>
                    <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                        <i class="bx bx-bed"></i> Data Pemesanan Kamar
                    </h3>

                    <div class="mb-4">
                        <label for="tipe_kamar" class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar <span class="text-maroon-700">*</span></label>
                        <select id="tipe_kamar" name="tipe_kamar" required
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>Pilih Tipe Kamar</option>
                            @foreach ($kamars as $kamar)
                                <option value="{{ $kamar->nama_ekstra }}"
                                    data-harga="{{ $kamar->harga_default }}"
                                    data-keterangan="{{ $kamar->keterangan }}"
                                    @selected($kamar->nama_ekstra == old('tipe_kamar'))>
                                    {{ $kamar->nama_ekstra }} | Rp.{{ number_format($kamar->harga_default, 0, ',', '.') }} | {{ $kamar->deskripsi }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipe_kamar')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jumlah_pengisi" class="mb-1.5 block text-sm font-medium text-stone-700">Jumlah Pengisi</label>
                        <input type="number" id="jumlah_pengisi" name="jumlah_pengisi" value="{{ old('jumlah_pengisi') }}" readonly
                            placeholder="Jumlah Pengisi"
                            class="w-full rounded-lg border border-cream-300 bg-cream-100 px-3 py-2 text-sm text-stone-600">
                        @error('jumlah_pengisi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <p id="keterangan_description" class="mt-1 text-xs text-stone-500"></p>
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="mb-1.5 block text-sm font-medium text-stone-700">Harga</label>
                        <input type="number" id="harga" name="harga" value="{{ old('harga') }}" readonly
                            placeholder="Total Harga"
                            class="w-full rounded-lg border border-cream-300 bg-cream-100 px-3 py-2 text-sm text-stone-600">
                        @error('harga')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-textarea label="Keterangan / Catatan" name="keterangan" :rows="3" placeholder="Masukkan keterangan tambahan (opsional)" />
                </x-card>

                <div class="mt-6 flex items-center justify-between">
                    <x-button variant="secondary" href="{{ url()->previous() }}">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                    <div class="flex gap-2">
                        <button type="reset" class="rounded-lg border border-cream-300 px-4 py-2 text-sm font-semibold text-stone-600 hover:bg-cream-100">
                            <i class="bx bx-reset"></i> Reset
                        </button>
                        <x-button type="submit">
                            <i class="bx bx-save"></i> Simpan Pemesanan
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipeKamarSelect = document.getElementById('tipe_kamar');
            const jumlahPengisiInput = document.getElementById('jumlah_pengisi');
            const hargaInput = document.getElementById('harga');
            const keteranganDescription = document.getElementById('keterangan_description');

            function updateFormFields() {
                const selectedOption = tipeKamarSelect.options[tipeKamarSelect.selectedIndex];

                if (tipeKamarSelect.selectedIndex <= 0) {
                    jumlahPengisiInput.value = '';
                    hargaInput.value = '';
                    keteranganDescription.textContent = '';
                    jumlahPengisiInput.readOnly = true;
                    return;
                }

                const harga = selectedOption.getAttribute('data-harga');
                const keterangan = selectedOption.getAttribute('data-keterangan');
                hargaInput.value = harga || '';
                keteranganDescription.textContent = keterangan || '';

                if (!keterangan) {
                    jumlahPengisiInput.readOnly = false;
                    jumlahPengisiInput.value = '';
                    return;
                }

                jumlahPengisiInput.readOnly = false;

                let match = keterangan.match(/harus diisi (\d+) orang/);
                if (match) {
                    jumlahPengisiInput.value = match[1];
                    jumlahPengisiInput.readOnly = true;
                    return;
                }

                match = keterangan.match(/dapat diisi 1 s\/d (\d+) orang/);
                if (match) {
                    jumlahPengisiInput.value = 1;
                    jumlahPengisiInput.readOnly = false;
                    return;
                }

                match = keterangan.match(/(?:hanya dapat|dapat) diisi (\d+) orang/);
                if (match) {
                    jumlahPengisiInput.value = match[1];
                    jumlahPengisiInput.readOnly = true;
                }
            }

            tipeKamarSelect.addEventListener('change', updateFormFields);

            if (tipeKamarSelect.value) {
                updateFormFields();
            }
        });
    </script>
@endsection
