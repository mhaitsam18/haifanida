@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-1/2">
        <form action="/admin/pemesanan-ekstra" method="post">
            @csrf
            <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id ?? null }}">

            <div class="mb-4">
                <label for="ekstra" class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra / Tambahan</label>
                <select id="ekstra" name="ekstra"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Ekstra</option>
                    @foreach ($ekstras as $ekstra)
                        <option value="{{ $ekstra->nama_ekstra }}" data-harga="{{ $ekstra->harga_default }}" data-keterangan="{{ $ekstra->keterangan }}" @selected($ekstra->nama_ekstra == old('ekstra'))>
                            {{ $ekstra->nama_ekstra }} | Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('ekstra')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Jumlah" name="jumlah" type="number" :value="old('jumlah')" placeholder="Jumlah" />
            <p id="keterangan_description" class="-mt-3 mb-4 text-xs text-stone-500"></p>

            <x-form-input label="Total Harga" name="total_harga" type="number" :value="old('total_harga')" placeholder="Total Harga" />
            <x-form-textarea label="Keterangan" name="keterangan" :value="old('keterangan')" placeholder="Keterangan" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/' . ($pemesanan ? 'pemesanan/' . $pemesanan->id . '/' : '') . 'pemesanan-ekstra'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        (function () {
            const ekstraSelect = document.getElementById('ekstra');
            const jumlahInput = document.getElementById('jumlah');
            const totalHargaInput = document.getElementById('total_harga');
            const keteranganDescription = document.getElementById('keterangan_description');

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
        })();
    </script>
@endsection
