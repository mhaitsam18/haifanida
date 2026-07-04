@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-1/2">
        <form action="/admin/permintaan-kamar/{{ $permintaanKamar->id }}" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="pemesanan_kamar_id" value="{{ $permintaanKamar->pemesanan_kamar_id }}">

            <div class="mb-4">
                <label for="permintaan" class="mb-1.5 block text-sm font-medium text-stone-700">Permintaan</label>
                <select id="permintaan" name="permintaan"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Permintaan</option>
                    @foreach ($permintaans as $permintaan)
                        <option value="{{ $permintaan->nama_ekstra }}" @selected($permintaan->nama_ekstra == old('permintaan', $permintaanKamar->permintaan))>{{ $permintaan->nama_ekstra }}</option>
                    @endforeach
                    <option value="permintaan_khusus">Permintaan Tidak Tersedia</option>
                </select>
                @error('permintaan')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="permintaanKhususField" class="mb-4" style="display:none">
                <label for="permintaan_khusus" class="mb-1.5 block text-sm font-medium text-stone-700">Permintaan Khusus</label>
                <input type="text" id="permintaan_khusus" name="permintaan_khusus" placeholder="Masukkan Permintaan Khusus"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
            </div>

            <x-form-input label="Harga" name="harga" type="number" :value="old('harga', $permintaanKamar->harga)" placeholder="Total Harga" />
            <x-form-textarea label="Keterangan" name="keterangan" :value="old('keterangan', $permintaanKamar->keterangan)" placeholder="Keterangan" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/' . ($permintaanKamar->pemesanan_kamar_id ? 'pemesanan-kamar/' . $permintaanKamar->pemesanan_kamar_id . '/' : '') . 'permintaan-kamar'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        document.getElementById('permintaan').addEventListener('change', function () {
            document.getElementById('permintaanKhususField').style.display = this.value === 'permintaan_khusus' ? '' : 'none';
        });
    </script>
@endsection
