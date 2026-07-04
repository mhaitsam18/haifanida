@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/perwakilan" method="post">
            @csrf
            <x-form-input label="Nama Perwakilan" name="nama_kantor" :value="old('nama_kantor')" placeholder="Nama Perwakilan" />
            <x-form-input label="Nama Ketua" name="nama_ketua" :value="old('nama_ketua')" placeholder="Nama Ketua" />
            <x-form-input label="Kontak" name="kontak_kantor" :value="old('kontak_kantor')" placeholder="Kontak" />
            <x-form-input label="Nomor Surat Izin" name="surat_izin" :value="old('surat_izin')" placeholder="Nomor Surat Izin" />

            <div class="mb-4">
                <label for="provinsi_id" class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                <select id="provinsi_id" name="provinsi_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Provinsi</option>
                    @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id'))>{{ $provinsi->provinsi }}</option>
                    @endforeach
                </select>
                @error('provinsi_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kabupaten_id" class="mb-1.5 block text-sm font-medium text-stone-700">Kabupaten / Kota</label>
                <select id="kabupaten_id" name="kabupaten_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Kabupaten</option>
                    @if (old('kabupaten_id'))
                        @foreach ($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == old('kabupaten_id'))>{{ $kabupaten->kabupaten }}</option>
                        @endforeach
                    @endif
                </select>
                @error('kabupaten_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Kecamatan" name="kecamatan" :value="old('kecamatan')" placeholder="Kecamatan" />
            <x-form-textarea label="Detail Alamat" name="alamat_kantor" :value="old('alamat_kantor')" placeholder="Alamat" />
            <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="old('kode_pos')" placeholder="Kode Pos" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="/admin/perwakilan">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        document.getElementById('provinsi_id').addEventListener('change', function () {
            fetch('/get-kabupaten', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ provinsi_id: this.value }),
            })
                .then(response => response.json())
                .then(data => {
                    const kabupatenSelect = document.getElementById('kabupaten_id');
                    kabupatenSelect.innerHTML = '<option value="" selected disabled>Pilih Kabupaten</option>';
                    data.forEach(kabupaten => {
                        const option = document.createElement('option');
                        option.value = kabupaten.id;
                        option.textContent = kabupaten.kabupaten;
                        kabupatenSelect.appendChild(option);
                    });
                });
        });
    </script>
@endsection
