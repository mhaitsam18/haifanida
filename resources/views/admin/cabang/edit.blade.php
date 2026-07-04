@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/cabang/{{ $cabang->id }}" method="post">
            @method('put')
            @csrf
            <x-form-input label="Nama Cabang" name="nama_kantor" :value="old('nama_kantor', $cabang->nama_kantor)" placeholder="Nama Cabang" />

            <div class="mb-4">
                <label for="induk_kantor_id" class="mb-1.5 block text-sm font-medium text-stone-700">Perwakilan Induk</label>
                <select id="induk_kantor_id" name="induk_kantor_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected>Tidak ada (langsung di bawah Pusat)</option>
                    @foreach ($perwakilans as $perwakilan)
                        <option value="{{ $perwakilan->id }}" @selected($perwakilan->id == old('induk_kantor_id', $cabang->induk_kantor_id))>{{ $perwakilan->nama_kantor }}</option>
                    @endforeach
                </select>
                @error('induk_kantor_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Nama Ketua" name="nama_ketua" :value="old('nama_ketua', $cabang->nama_ketua)" placeholder="Nama Ketua" />
            <x-form-input label="Kontak" name="kontak_kantor" :value="old('kontak_kantor', $cabang->kontak_kantor)" placeholder="Kontak" />
            <x-form-input label="Nomor Surat Izin" name="surat_izin" :value="old('surat_izin', $cabang->surat_izin)" placeholder="Nomor Surat Izin" />

            <div class="mb-4">
                <label for="provinsi_id" class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                <select id="provinsi_id" name="provinsi_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Provinsi</option>
                    @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id', $cabang->kabupaten->provinsi_id ?? null))>{{ $provinsi->provinsi }}</option>
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
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == old('kabupaten_id', $cabang->kabupaten_id))>{{ $kabupaten->kabupaten }}</option>
                    @endforeach
                </select>
                @error('kabupaten_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Kecamatan" name="kecamatan" :value="old('kecamatan', $cabang->kecamatan)" placeholder="Kecamatan" />
            <x-form-textarea label="Detail Alamat" name="alamat_kantor" :value="old('alamat_kantor', $cabang->alamat_kantor)" placeholder="Alamat" />
            <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="old('kode_pos', $cabang->kode_pos)" placeholder="Kode Pos" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="/admin/cabang">Kembali</x-button>
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
