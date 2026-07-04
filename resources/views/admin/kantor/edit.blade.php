@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <form action="/admin/kantor/{{ $kantor->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <x-form-input label="Nama Kantor" name="nama_kantor" :value="old('nama_kantor', $kantor->nama_kantor)" placeholder="Nama Kantor" />
                <x-form-input label="Nama Ketua/Pimpinan" name="nama_ketua" :value="old('nama_ketua', $kantor->nama_ketua)" placeholder="Nama Ketua/Pimpinan" />
                <x-form-input label="Kontak Kantor" name="kontak_kantor" :value="old('kontak_kantor', $kantor->kontak_kantor)" placeholder="Kontak Kantor" />

                <div class="mb-4">
                    <label for="provinsi_id" class="mb-1.5 block text-sm font-medium text-stone-700">Provinsi</label>
                    <select id="provinsi_id" name="provinsi_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Provinsi</option>
                        @foreach ($provinsis as $provinsi)
                            <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id', $kantor->kabupaten->provinsi_id ?? null))>{{ $provinsi->provinsi }}</option>
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
                            <option value="{{ $kabupaten->id }}" @selected($kabupaten->id == old('kabupaten_id', $kantor->kabupaten_id))>{{ $kabupaten->kabupaten }}</option>
                        @endforeach
                    </select>
                    @error('kabupaten_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-textarea label="Detail Alamat" name="alamat_kantor" :value="old('alamat_kantor', $kantor->alamat_kantor)" placeholder="Alamat Kantor" />
                <x-form-input label="Kode Pos" name="kode_pos" type="number" :value="old('kode_pos', $kantor->kode_pos)" placeholder="Kode Pos" />

                <div class="mb-4">
                    <label for="jenis_kantor" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Kantor</label>
                    <select id="jenis_kantor" name="jenis_kantor"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected disabled>Pilih Jenis Kantor</option>
                        <option value="pusat" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'pusat')>Pusat</option>
                        <option value="perwakilan" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'perwakilan')>Perwakilan</option>
                        <option value="cabang" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'cabang')>Cabang</option>
                        <option value="agen" @selected(old('jenis_kantor', $kantor->jenis_kantor) == 'agen')>Agen</option>
                    </select>
                    @error('jenis_kantor')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="foto_kantor" class="mb-1.5 block text-sm font-medium text-stone-700">Foto Kantor</label>
                    <input type="file" id="foto_kantor" name="foto_kantor"
                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    @error('foto_kantor')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <x-button variant="secondary" href="/admin/kantor">Kembali</x-button>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>

        <x-card title="Pratinjau Foto">
            <img src="{{ $kantor->foto_kantor ? asset('storage/' . $kantor->foto_kantor) : '' }}" alt="" class="img-preview aspect-4/3 w-full rounded-lg object-cover">
        </x-card>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('foto_kantor').addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => document.querySelector('.img-preview').src = e.target.result;
                reader.readAsDataURL(file);
            });

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
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
