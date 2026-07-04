@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-1/2">
        <form action="/admin/pemesanan-kamar" method="post">
            @csrf
            <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id ?? null }}">

            <div class="mb-4">
                <label for="tipe_kamar" class="mb-1.5 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                <select id="tipe_kamar" name="tipe_kamar"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Tipe Kamar</option>
                    @foreach ($kamars as $kamar)
                        <option value="{{ $kamar->nama_ekstra }}" data-harga="{{ $kamar->harga_default }}" data-keterangan="{{ $kamar->keterangan }}" @selected($kamar->nama_ekstra == old('tipe_kamar'))>
                            {{ $kamar->nama_ekstra }} | Rp.{{ number_format($kamar->harga_default, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('tipe_kamar')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Jumlah Pengisi" name="jumlah_pengisi" type="number" :value="old('jumlah_pengisi')" placeholder="Jumlah Pengisi" max="4" />
            <p id="keterangan_description" class="-mt-3 mb-4 text-xs text-stone-500"></p>

            <x-form-input label="Harga" name="harga" type="number" :value="old('harga')" placeholder="Total Harga" />
            <x-form-textarea label="Keterangan" name="keterangan" :value="old('keterangan')" placeholder="Keterangan" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/' . ($pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '') . 'pemesanan-kamar'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        (function () {
            const tipeKamarSelect = document.getElementById('tipe_kamar');
            const jumlahPengisiInput = document.getElementById('jumlah_pengisi');
            const hargaInput = document.getElementById('harga');
            const keteranganDescription = document.getElementById('keterangan_description');

            const defaultOccupants = {
                'tipe kamar quad gabung': null,
                'tipe kamar quad keluarga': 4,
                'tipe kamar quad keluarga isi 3 dan 1 bed kosong': 3,
                'tipe kamar double gabung': 1,
                'tipe kamar double keluarga': 2,
                'tipe kamar single': 1,
            };

            function updatePriceAndDescription() {
                const selected = tipeKamarSelect.options[tipeKamarSelect.selectedIndex];

                if (selected && selected.value !== '') {
                    if (Object.prototype.hasOwnProperty.call(defaultOccupants, selected.value)) {
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

                    keteranganDescription.textContent = selected.getAttribute('data-keterangan') ?? '';

                    const harga = parseFloat(selected.getAttribute('data-harga'));
                    const jumlah = jumlahPengisiInput.value;
                    if (jumlah !== '' && !isNaN(jumlah)) {
                        hargaInput.value = (harga * parseInt(jumlah)).toFixed(2);
                    } else {
                        hargaInput.value = harga.toFixed(2);
                    }
                } else {
                    keteranganDescription.textContent = '';
                    hargaInput.value = '';
                    jumlahPengisiInput.value = '';
                    jumlahPengisiInput.readOnly = false;
                }
            }

            tipeKamarSelect.addEventListener('change', updatePriceAndDescription);
            jumlahPengisiInput.addEventListener('input', updatePriceAndDescription);
        })();
    </script>
@endsection
