@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/sertifikat-jemaah/{{ $sertifikatJemaah->id }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $sertifikatJemaah->id }}">
            <input type="hidden" name="jemaah_id" id="jemaah_id" value="{{ $sertifikatJemaah->jemaah_id }}">

            <x-form-input label="Nomor Sertifikat" name="nomor_sertifikat" :value="old('nomor_sertifikat', $sertifikatJemaah->nomor_sertifikat)" placeholder="Nomor Sertifikat" />
            <x-form-input label="Tanggal Penerbitan" name="tanggal_penerbitan" type="date" :value="old('tanggal_penerbitan', $sertifikatJemaah->tanggal_penerbitan)" />
            <x-form-input label="Tanggal Kadaluarsa" name="tanggal_kadaluarsa" type="date" :value="old('tanggal_kadaluarsa', $sertifikatJemaah->tanggal_kadaluarsa)" />
            <x-form-input label="Jenis Sertifikat" name="jenis_sertifikat" :value="old('jenis_sertifikat', $sertifikatJemaah->jenis_sertifikat)" placeholder="Jenis Sertifikat" />

            <div class="mb-4">
                <label for="sertifikat" class="mb-1.5 block text-sm font-medium text-stone-700">File Sertifikat</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $sertifikatJemaah->sertifikat) }}" class="img-preview h-24 w-32 rounded-lg border border-cream-200 object-cover">
                </div>
                <input type="file" id="sertifikat" name="sertifikat"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700 @error('sertifikat') border-red-400 @enderror">
                @error('sertifikat')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" href="javascript:history.back()">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        document.getElementById('sertifikat').addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.img-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
