@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card>
        <form action="/admin/isu-perjalanan/{{ $isuPerjalanan->id }}" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="grup_id" value="{{ $isuPerjalanan->grup_id }}">

            <div class="grid gap-x-6 md:grid-cols-2">
                <div>
                    <x-form-input label="Masalah" name="masalah" :value="old('masalah', $isuPerjalanan->masalah)" placeholder="Masalah" required />
                    <x-form-input label="Solusi" name="solusi" :value="old('solusi', $isuPerjalanan->solusi)" placeholder="Solusi" />
                </div>
                <div>
                    <x-form-input label="Waktu Pelaporan" name="waktu_pelaporan" type="datetime-local" :value="old('waktu_pelaporan', $isuPerjalanan->waktu_pelaporan)" />
                    <x-form-input label="Waktu Penyelesaian" name="waktu_penyelesaian" type="datetime-local" :value="old('waktu_penyelesaian', $isuPerjalanan->waktu_penyelesaian)" />
                    <div class="mb-4">
                        <label class="inline-flex items-center gap-2 text-sm font-medium text-stone-700">
                            <input type="checkbox" value="1" name="status" class="rounded border-cream-300 text-maroon-700 focus:ring-maroon-300" @checked(old('status', $isuPerjalanan->status))>
                            Dalam Penanganan?
                        </label>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/grup/' . $isuPerjalanan->grup_id . '/isu-perjalanan'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection
