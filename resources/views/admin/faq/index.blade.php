@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show()" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah FAQ">
            <form action="/admin/faq" method="post" @submit="submit">
                @csrf
                <x-form-input label="Pertanyaan" name="pertanyaan" placeholder="Pertanyaan" />
                <x-form-error name="pertanyaan" />

                <x-form-textarea label="Jawaban" name="jawaban" placeholder="Jawaban" :rows="5" />
                <x-form-error name="jawaban" />

                <x-form-input label="Kategori (opsional)" name="kategori" placeholder="cth. Umroh, Pembayaran, Dokumen" />
                <x-form-error name="kategori" />

                <x-form-input label="Urutan" name="urutan" type="number" value="0" />
                <x-form-error name="urutan" />

                <div class="mb-4">
                    <label class="flex items-center gap-2 text-sm text-stone-700">
                        <input type="checkbox" value="1" name="is_active" checked class="rounded text-maroon-700 focus:ring-maroon-400">
                        Tampilkan di halaman publik
                    </label>
                    <x-form-error name="is_active" />
                </div>

                <div class="flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div>

    <x-data-table searchPlaceholder="Cari FAQ...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Pertanyaan</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Urutan</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($faqs as $faq)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-stone-800">{{ $faq->pertanyaan }}</div>
                            <div class="mt-1 max-w-xl text-xs text-stone-500">{{ \Illuminate\Support\Str::limit($faq->jawaban, 120) }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @if ($faq->kategori)
                                <x-badge variant="brand">{{ $faq->kategori }}</x-badge>
                            @else
                                <span class="text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $faq->urutan }}</td>
                        <td class="px-4 py-3">
                            @if ($faq->is_active)
                                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">Aktif</span>
                            @else
                                <span class="rounded-full bg-stone-100 px-2.5 py-1 text-xs font-medium text-stone-500">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/faq/' . $faq->id" />

                                <x-modal title="Edit FAQ">
                                    <form action="/admin/faq/{{ $faq->id }}" method="post" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <x-form-input label="Pertanyaan" name="pertanyaan" :value="$faq->pertanyaan" placeholder="Pertanyaan" />
                                        <x-form-error name="pertanyaan" />

                                        <x-form-textarea label="Jawaban" name="jawaban" :value="$faq->jawaban" placeholder="Jawaban" :rows="5" />
                                        <x-form-error name="jawaban" />

                                        <x-form-input label="Kategori (opsional)" name="kategori" :value="$faq->kategori" placeholder="cth. Umroh, Pembayaran, Dokumen" />
                                        <x-form-error name="kategori" />

                                        <x-form-input label="Urutan" name="urutan" type="number" :value="$faq->urutan" />
                                        <x-form-error name="urutan" />

                                        <div class="mb-4">
                                            <label class="flex items-center gap-2 text-sm text-stone-700">
                                                <input type="checkbox" value="1" name="is_active" @checked($faq->is_active) class="rounded text-maroon-700 focus:ring-maroon-400">
                                                Tampilkan di halaman publik
                                            </label>
                                            <x-form-error name="is_active" />
                                        </div>

                                        <div class="flex justify-end gap-2">
                                            <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                                            <x-button type="submit">
                                                <span x-show="!submitting">Simpan</span>
                                                <span x-show="submitting">Menyimpan...</span>
                                            </x-button>
                                        </div>
                                    </form>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection
