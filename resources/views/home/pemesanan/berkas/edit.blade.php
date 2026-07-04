@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Str;
    @endphp

    <section class="py-10">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="font-display text-2xl font-semibold text-maroon-900">Edit Berkas Jemaah</h2>
                    <p class="mt-1 font-medium text-maroon-700">{{ $jemaah->nama_lengkap }}</p>
                </div>
                <x-button variant="secondary" :href="route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id])">
                    <i class="bx bx-arrow-back"></i> Kembali
                </x-button>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <x-card :title="'Edit Berkas: ' . $berkasJemaah->berkas->nama_berkas">
                <form action="{{ route('pemesanan.jemaah.berkas.update', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div>
                            <x-form-input label="Nama Berkas" name="nama_berkas" :value="$berkasJemaah->berkas->nama_berkas" readonly disabled />

                            <div class="mb-4">
                                <label for="file_path" class="mb-1.5 block text-sm font-medium text-stone-700">File Berkas <span class="text-maroon-700">*</span></label>
                                <input type="file" id="file_path" name="file_path" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx"
                                    class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                <p class="mt-1 text-xs text-stone-500">Format yang diizinkan: JPG, JPEG, PNG, GIF, PDF, DOC, DOCX. Maksimal 3MB.</p>
                                @error('file_path')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-2">
                                <x-button variant="secondary" :href="route('pemesanan.jemaah.berkas', [$pemesanan->id, $jemaah->id])">
                                    <i class="bx bx-x"></i> Batal
                                </x-button>
                                <x-button type="submit">
                                    <i class="bx bx-save"></i> Simpan Perubahan
                                </x-button>
                            </div>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">File Saat Ini</label>
                            @if ($berkasJemaah->file_path)
                                @php
                                    $fileExtension = pathinfo($berkasJemaah->file_path, PATHINFO_EXTENSION);
                                    $fileName = basename($berkasJemaah->file_path);
                                @endphp
                                <div class="rounded-xl border border-cream-200 bg-cream-100 p-4 text-center">
                                    <div class="mb-3 flex items-center justify-center gap-2">
                                        <i class="bx {{ strtolower($fileExtension) == 'pdf' ? 'bxs-file-pdf text-red-600' : 'bxs-file text-stone-500' }} text-2xl"></i>
                                        <div class="text-left">
                                            <div class="text-xs font-semibold">{{ strtoupper($fileExtension) }} File</div>
                                            <div class="text-xs text-stone-500">{{ Str::limit($fileName, 20) }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('pemesanan.jemaah.berkas.preview', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" target="_blank"
                                        class="inline-flex items-center gap-1 rounded-lg border border-cream-300 bg-cream-50 px-3 py-1.5 text-xs font-medium text-stone-700 hover:bg-cream-200">
                                        <i class="bx bx-show"></i> Lihat
                                    </a>
                                    <p class="mt-2 text-xs text-stone-500">Diupload: {{ Carbon::parse($berkasJemaah->updated_at)->format('d/m/Y H:i') }}</p>
                                </div>
                            @else
                                <div class="rounded-xl border border-cream-200 bg-cream-100 p-6 text-center text-stone-500">
                                    <i class="bx bx-file-blank text-3xl"></i>
                                    <p class="mt-1 text-sm">Tidak ada file</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </section>
@endsection
