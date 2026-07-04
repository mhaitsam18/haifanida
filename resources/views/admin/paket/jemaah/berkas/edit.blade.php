@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-2/3">
        <form action="/admin/berkas-jemaah/{{ $berkasJemaah->id }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $berkasJemaah->id }}">
            <input type="hidden" name="jemaah_id" id="jemaah_id" value="{{ $berkasJemaah->jemaah_id }}">

            <div class="mb-4">
                <label for="berkas_id" class="mb-1.5 block text-sm font-medium text-stone-700">Nama Berkas</label>
                <select id="berkas_id" name="berkas_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Berkas</option>
                    @foreach ($berkass as $item_berkas)
                        <option value="{{ $item_berkas->id }}" @selected($item_berkas->id == old('berkas_id', $berkasJemaah->berkas_id, $berkas->id ?? null))>
                            {{ $item_berkas->nama_berkas }}</option>
                    @endforeach
                </select>
                @error('berkas_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="mb-1.5 block text-sm font-medium text-stone-700">Status</label>
                <select id="status" name="status"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Status</option>
                    <option value="tertunda" @selected(old('status', $berkasJemaah->status) == 'tertunda')>Tertunda</option>
                    <option value="diverifikasi" @selected(old('status', $berkasJemaah->status) == 'diverifikasi')>Diverifikasi</option>
                    <option value="ditolak" @selected(old('status', $berkasJemaah->status) == 'ditolak')>Ditolak</option>
                </select>
                @error('status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file_path" class="mb-1.5 block text-sm font-medium text-stone-700">File Berkas</label>
                <input type="file" id="file_path" name="file_path"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-maroon-50 file:px-3 file:py-1.5 file:text-maroon-700 @error('file_path') border-red-400 @enderror">
                @error('file_path')
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
