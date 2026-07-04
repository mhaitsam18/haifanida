@extends('layouts.app')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <section class="py-10">
        <div class="mx-auto max-w-2xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Tambah Permintaan Kamar</h2>
                <p class="mt-1 text-sm text-stone-500">Silakan pilih permintaan kamar yang diinginkan</p>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
            @endif

            <form action="{{ route('permintaan-kamar.store') }}" method="POST" id="permintaanForm">
                @csrf

                <x-card>
                    <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                        <i class="bx bx-bed"></i> Data Permintaan Kamar
                    </h3>

                    <div class="mb-4">
                        <label for="permintaan_kamar" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kamar <span class="text-maroon-700">*</span></label>
                        <select id="permintaan_kamar" name="permintaan_kamar" required onchange="updateHarga()"
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option selected disabled value="">Pilih Jenis Kamar</option>
                            @forelse ($jenisKamar as $kamar)
                                <option value="{{ $kamar->nama_ekstra }}" data-harga="{{ $kamar->harga_default }}" data-deskripsi="{{ $kamar->deskripsi }}"
                                    @selected(old('permintaan_kamar') == $kamar->nama_ekstra)>
                                    {{ $kamar->nama_ekstra }}
                                    @if ($kamar->deskripsi)
                                        - {{ Str::limit($kamar->deskripsi, 50) }}
                                    @endif
                                </option>
                            @empty
                                <option disabled>Tidak ada jenis kamar tersedia</option>
                            @endforelse
                        </select>
                        @error('permintaan_kamar')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-stone-500">Pilih jenis kamar sesuai kebutuhan Anda</p>
                    </div>

                    <div class="mb-4 hidden rounded-lg bg-sky-50 px-3 py-2 text-sm text-sky-800" id="deskripsi-container">
                        <i class="bx bx-info-circle"></i> <strong>Deskripsi:</strong> <span id="deskripsi-text"></span>
                    </div>

                    <div class="mb-4">
                        <label for="harga_display" class="mb-1.5 block text-sm font-medium text-stone-700">Harga <span class="text-maroon-700">*</span></label>
                        <input type="text" id="harga_display" readonly placeholder="Harga akan muncul otomatis"
                            value="{{ old('harga') ? 'Rp ' . number_format(old('harga'), 0, ',', '.') : '' }}"
                            class="w-full rounded-lg border border-cream-300 bg-cream-100 px-3 py-2 text-sm text-stone-600">
                        <input type="hidden" id="harga" name="harga" value="{{ old('harga') }}">
                        @error('harga')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-stone-500">Harga disesuaikan otomatis dari jenis kamar yang dipilih</p>
                    </div>

                    <div class="mb-2">
                        <x-form-textarea label="Keterangan / Catatan" name="keterangan" :rows="3" maxlength="1000" placeholder="Masukkan keterangan atau catatan tambahan (opsional)" />
                        <p class="-mt-3 text-xs text-stone-500"><span id="char-count">0</span>/1000 karakter</p>
                    </div>
                </x-card>

                <div class="mt-6 flex items-center justify-between">
                    <x-button variant="secondary" :href="route('permintaan.kamar.create')">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                    <div class="flex gap-2">
                        <button type="reset" onclick="resetForm()" class="rounded-lg border border-cream-300 px-4 py-2 text-sm font-semibold text-stone-600 hover:bg-cream-100">
                            <i class="bx bx-reset"></i> Reset
                        </button>
                        <x-button type="submit" id="submitBtn">
                            <i class="bx bx-save"></i> Simpan Data
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function updateHarga() {
            const permintaanSelect = document.getElementById('permintaan_kamar');
            const hargaDisplay = document.getElementById('harga_display');
            const hargaInput = document.getElementById('harga');
            const deskripsiContainer = document.getElementById('deskripsi-container');
            const deskripsiText = document.getElementById('deskripsi-text');

            if (permintaanSelect.selectedIndex > 0) {
                const selectedOption = permintaanSelect.options[permintaanSelect.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');
                const deskripsi = selectedOption.getAttribute('data-deskripsi');

                hargaDisplay.value = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(harga);
                hargaInput.value = harga;

                if (deskripsi && deskripsi.trim() !== '') {
                    deskripsiText.textContent = deskripsi;
                    deskripsiContainer.classList.remove('hidden');
                } else {
                    deskripsiContainer.classList.add('hidden');
                }
            } else {
                hargaDisplay.value = '';
                hargaInput.value = '';
                deskripsiContainer.classList.add('hidden');
            }
        }

        function resetForm() {
            document.getElementById('permintaanForm').reset();
            document.getElementById('harga_display').value = '';
            document.getElementById('harga').value = '';
            document.getElementById('deskripsi-container').classList.add('hidden');
            updateCharCount();
        }

        function updateCharCount() {
            const keteranganTextarea = document.getElementById('keterangan');
            document.getElementById('char-count').textContent = keteranganTextarea.value.length;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const keteranganTextarea = document.getElementById('keterangan');
            keteranganTextarea.addEventListener('input', updateCharCount);
            updateCharCount();

            const permintaanSelect = document.getElementById('permintaan_kamar');
            if (permintaanSelect.value) {
                updateHarga();
            }

            document.getElementById('permintaanForm').addEventListener('submit', function (event) {
                const submitBtn = document.getElementById('submitBtn');
                if (permintaanSelect.selectedIndex === 0) {
                    event.preventDefault();
                    permintaanSelect.focus();
                    return false;
                }
                submitBtn.disabled = true;
            });
        });
    </script>
@endsection
