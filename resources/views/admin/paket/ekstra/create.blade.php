@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <x-card class="lg:w-1/2">
        <form action="/admin/paket-ekstra" method="post">
            @csrf
            <input type="hidden" name="paket_id" value="{{ $paket->id ?? null }}">

            <div class="mb-4">
                <label for="ekstra_id" class="mb-1.5 block text-sm font-medium text-stone-700">Ekstra</label>
                <select id="ekstra_id" name="ekstra_id"
                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                    <option value="" selected disabled>Pilih Ekstra</option>
                    @foreach ($ekstras as $ekstra)
                        <option value="{{ $ekstra->id }}" data-harga="{{ $ekstra->harga_default }}" @selected($ekstra->id == old('ekstra_id'))>{{ $ekstra->nama_ekstra }}</option>
                    @endforeach
                </select>
                @error('ekstra_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-form-input label="Harga" name="harga" type="number" :value="old('harga')" placeholder="Harga" />

            <div class="flex justify-end gap-2">
                <x-button variant="secondary" :href="'/admin/paket/' . $paket->id . '/paket-ekstra'">Kembali</x-button>
                <x-button type="submit">Simpan</x-button>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        document.getElementById('ekstra_id').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            if (selected.value !== '') {
                document.getElementById('harga').value = parseFloat(selected.getAttribute('data-harga'));
            }
        });
    </script>
@endsection
