@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show(); $nextTick(() => initTinyMCE('isi_konten_new'))" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Konten" maxWidth="max-w-4xl">
            <form action="/admin/konten" method="post" enctype="multipart/form-data" @submit="if (typeof tinymce !== 'undefined') tinymce.triggerSave(); submit($event)">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <x-form-input label="Nama Konten" name="nama" placeholder="Nama" />
                        <x-form-error name="nama" />

                        <x-form-input label="Judul" name="judul" placeholder="Judul" />
                        <x-form-error name="judul" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                            <input type="file" name="gambar" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <x-form-error name="gambar" />
                        </div>
                    </div>

                    <div>
                        <x-card title="Pratinjau Gambar">
                            <img x-show="previewUrl" :src="previewUrl" class="aspect-4/3 w-full rounded-lg object-cover">
                        </x-card>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="isi_konten_new" class="mb-1.5 block text-sm font-medium text-stone-700">Isi Konten</label>
                    <textarea id="isi_konten_new" name="isi_konten" rows="10" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm"></textarea>
                    <x-form-error name="isi_konten" />
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                    <x-button type="submit">
                        <span x-show="!submitting">Simpan</span>
                        <span x-show="submitting">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div>

    <x-data-table searchPlaceholder="Cari konten...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Penulis</th>
                    <th class="px-4 py-3">Nama Konten</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($kontens as $konten)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $konten->user->name ?? '-' }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $konten->nama }}</td>
                        <td class="px-4 py-3">{{ $konten->judul }}</td>
                        <td class="px-4 py-3">
                            @if ($konten->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($konten->gambar))
                                <img src="{{ asset('storage/' . $konten->gambar) }}" alt="{{ $konten->nama }}" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                @if (!$konten->user_id || auth()->user()->id == $konten->user_id)
                                    <button type="button" @click="show(); $nextTick(() => initTinyMCE('isi_konten_{{ $konten->id }}'))" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                    @if (!$konten->indelible)
                                        <x-delete-form :action="'/admin/konten/' . $konten->id" />
                                    @endif

                                    <x-modal title="Edit Konten" maxWidth="max-w-4xl">
                                        <form action="/admin/konten/{{ $konten->id }}" method="post" enctype="multipart/form-data" @submit="if (typeof tinymce !== 'undefined') tinymce.triggerSave(); submit($event)">
                                            @method('put')
                                            @csrf
                                            <div class="grid gap-6 lg:grid-cols-2">
                                                <div>
                                                    <x-form-input label="Nama Konten" name="nama" :value="$konten->nama" placeholder="Nama" />
                                                    <x-form-error name="nama" />

                                                    <x-form-input label="Judul" name="judul" :value="$konten->judul" placeholder="Judul" />
                                                    <x-form-error name="judul" />

                                                    <div class="mb-4">
                                                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                                                        <input type="file" name="gambar" @change="preview($event)"
                                                            class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                        <x-form-error name="gambar" />
                                                    </div>
                                                </div>

                                                <div>
                                                    <x-card title="Pratinjau Gambar">
                                                        <img :src="previewUrl || '{{ $konten->gambar ? asset('storage/' . $konten->gambar) : '' }}'" class="aspect-4/3 w-full rounded-lg object-cover">
                                                    </x-card>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="isi_konten_{{ $konten->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Isi Konten</label>
                                                <textarea id="isi_konten_{{ $konten->id }}" name="isi_konten" rows="10" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm">{{ $konten->isi_konten }}</textarea>
                                                <x-form-error name="isi_konten" />
                                            </div>

                                            <div class="mt-4 flex justify-end gap-2">
                                                <x-button type="button" variant="secondary" @click="hide()">Batal</x-button>
                                                <x-button type="submit">
                                                    <span x-show="!submitting">Simpan</span>
                                                    <span x-show="submitting">Menyimpan...</span>
                                                </x-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        function initTinyMCE(selectorId) {
            if (typeof tinymce === 'undefined') return;
            if (tinymce.get(selectorId)) return;
            tinymce.init({
                selector: '#' + selectorId,
                height: 400,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace wordcount visualblocks visualchars code fullscreen',
                toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                license_key: 'gpl',
            });
        }
    </script>
@endsection
