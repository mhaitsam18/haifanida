@extends('layouts.app')

@section('content')
    <section class="py-10">
        <div class="mx-auto max-w-2xl px-4">
            <div class="mb-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-maroon-900">Tambah Berkas Jemaah</h2>
                <p class="mt-1 text-sm text-stone-500">Silakan unggah dokumen persyaratan untuk jemaah</p>
                <p class="mt-1 font-medium text-maroon-700">{{ $jemaah->nama_lengkap }}</p>
            </div>

            <form action="{{ route('pemesanan.jemaah.berkas.store', [$pemesanan->id, $jemaah->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-card>
                    <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                        <i class="bx bx-upload"></i> Data Berkas Jemaah
                    </h3>

                    <div class="mb-4">
                        <label for="berkas_id" class="mb-1.5 block text-sm font-medium text-stone-700">Nama Berkas <span class="text-maroon-700">*</span></label>
                        <select id="berkas_id" name="berkas_id" required
                            class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                            <option value="" selected disabled>-- Pilih Jenis Berkas --</option>
                            @foreach ($berkass as $item_berkas)
                                <option value="{{ $item_berkas->id }}" @selected($item_berkas->id == old('berkas_id'))>
                                    {{ $item_berkas->nama_berkas }}
                                    @if ($item_berkas->keterangan)
                                        - {{ $item_berkas->keterangan }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('berkas_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="file_path" class="mb-1.5 block text-sm font-medium text-stone-700">Unggah File <span class="text-maroon-700">*</span></label>
                        <input type="file" id="file_path" name="file_path" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                            class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                        <p class="mt-1 text-xs text-stone-500">Format file yang didukung: PDF, JPG, PNG, DOC, DOCX. Ukuran maksimal: 2MB</p>
                        @error('file_path')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </x-card>

                <div class="mt-6 flex items-center justify-between">
                    <x-button variant="secondary" :href="route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id])">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </x-button>
                    <x-button type="submit">
                        <i class="bx bx-save"></i> Simpan Berkas
                    </x-button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                const fileInput = document.getElementById('file_path');
                if (fileInput.files.length) {
                    const maxSize = 2 * 1024 * 1024;
                    if (fileInput.files[0].size > maxSize) {
                        event.preventDefault();
                        alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    }
                }
            });
        });
    </script>
@endsection
