@extends('admin.layouts.app')

@section('content')
    <div x-data="modalForm()">
        <x-page-header :title="$title">
            <x-slot:actions>
                <button type="button" @click="show(); $nextTick(() => { initTinyMCE('fasilitas'); initTinyMCE('deskripsi'); })" class="inline-flex items-center gap-1.5 rounded-lg bg-maroon-700 px-4 py-2 text-sm font-semibold text-cream-50 hover:bg-maroon-800">
                    <i class="bx bx-plus"></i> Tambah
                </button>
            </x-slot:actions>
        </x-page-header>

        <x-modal title="Tambah Paket" maxWidth="max-w-4xl">
            <form action="/admin/paket" method="post" enctype="multipart/form-data" @submit="if (typeof tinymce !== 'undefined') tinymce.triggerSave(); submit($event)">
                @csrf
                <input type="hidden" name="kantor_id" value="{{ $kantor->id ?? null }}">

                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <x-form-input label="Nama Paket" name="nama_paket" placeholder="Nama Paket" />
                        <x-form-error name="nama_paket" />

                        <x-form-input label="Destinasi" name="destinasi" placeholder="Destinasi" />
                        <x-form-error name="destinasi" />

                        <div class="mb-4">
                            <label for="jenis_paket" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Paket</label>
                            <select id="jenis_paket" name="jenis_paket"
                                class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                <option value="" selected disabled>Pilih Jenis Paket</option>
                                <option value="umroh">Umroh</option>
                                <option value="haji">Haji</option>
                                <option value="wisata_halal">Wisata Halal</option>
                            </select>
                            <x-form-error name="jenis_paket" />
                        </div>

                        <x-form-input label="Durasi (hari)" name="durasi" type="number" placeholder="Durasi" />
                        <x-form-error name="durasi" />

                        <x-form-input label="Harga" name="harga" type="number" placeholder="Harga" />
                        <x-form-error name="harga" />

                        <x-form-input label="Kuota Jemaah (kosongkan jika tidak dibatasi)" name="kuota_jemaah" type="number" placeholder="Kuota Jemaah" />
                        <x-form-error name="kuota_jemaah" />

                        <x-form-input label="Tempat Keberangkatan" name="tempat_keberangkatan" placeholder="Tempat Keberangkatan" />
                        <x-form-error name="tempat_keberangkatan" />

                        <x-form-input label="Tempat Kepulangan" name="tempat_kepulangan" placeholder="Tempat Kepulangan" />
                        <x-form-error name="tempat_kepulangan" />

                        <x-form-input label="Tanggal Mulai" name="tanggal_mulai" type="date" />
                        <x-form-error name="tanggal_mulai" />

                        <x-form-input label="Tanggal Selesai" name="tanggal_selesai" type="date" />
                        <x-form-error name="tanggal_selesai" />

                        <x-form-textarea label="Fasilitas" name="fasilitas" :rows="6" />
                        <x-form-error name="fasilitas" />

                        <x-form-textarea label="Deskripsi" name="deskripsi" :rows="6" />
                        <x-form-error name="deskripsi" />

                        <div class="mb-4">
                            <label for="gambar" class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                            <input type="file" id="gambar" name="gambar" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <x-form-error name="gambar" />
                        </div>

                        <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                            <input type="hidden" name="published_at" value="">
                            <input type="checkbox" value="{{ now() }}" name="published_at" class="rounded text-maroon-700 focus:ring-maroon-400">
                            Terbitkan?
                        </label>
                    </div>

                    <div>
                        <x-card title="Pratinjau Gambar">
                            <img x-show="previewUrl" :src="previewUrl" alt="" class="aspect-4/3 w-full rounded-lg object-cover">
                        </x-card>
                    </div>
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

    <x-data-table searchPlaceholder="Cari paket...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Paket</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Durasi</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Keberangkatan</th>
                    <th class="px-4 py-3">Kepulangan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($pakets as $paket)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $paket->nama_paket }}</td>
                        <td class="px-4 py-3"><x-badge variant="brand">{{ $paket->jenis_paket }}</x-badge></td>
                        <td class="px-4 py-3">{{ $paket->durasi }} Hari</td>
                        <td class="px-4 py-3">Rp.{{ number_format($paket->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ Carbon\Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">{{ Carbon\Carbon::parse($paket->tanggal_selesai)->isoFormat('LL') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <a href="/admin/paket/{{ $paket->id }}" class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">Detail</a>
                                <button type="button" @click="show(); $nextTick(() => { initTinyMCE('fasilitas_{{ $paket->id }}'); initTinyMCE('deskripsi_{{ $paket->id }}'); })" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/paket/' . $paket->id" />

                                <x-modal title="Edit Paket" maxWidth="max-w-4xl">
                                    <form action="/admin/paket/{{ $paket->id }}" method="post" enctype="multipart/form-data" @submit="if (typeof tinymce !== 'undefined') tinymce.triggerSave(); submit($event)">
                                        @method('put')
                                        @csrf

                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <div class="lg:col-span-2">
                                                <div class="mb-4">
                                                    <label for="kantor_id_{{ $paket->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Kantor</label>
                                                    <select id="kantor_id_{{ $paket->id }}" name="kantor_id"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Kantor</option>
                                                        @foreach ($kantors as $kantor)
                                                            <option value="{{ $kantor->id }}" @selected($paket->kantor_id == $kantor->id)>{{ $kantor->nama_kantor }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form-error name="kantor_id" />
                                                </div>

                                                <x-form-input label="Nama Paket" name="nama_paket" :value="$paket->nama_paket" placeholder="Nama Paket" />
                                                <x-form-error name="nama_paket" />

                                                <x-form-input label="Destinasi" name="destinasi" :value="$paket->destinasi" placeholder="Destinasi" />
                                                <x-form-error name="destinasi" />

                                                <div class="mb-4">
                                                    <label for="jenis_paket_{{ $paket->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Jenis Paket</label>
                                                    <select id="jenis_paket_{{ $paket->id }}" name="jenis_paket"
                                                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                        <option value="" selected disabled>Pilih Jenis Paket</option>
                                                        <option value="umroh" @selected($paket->jenis_paket == 'umroh')>Umroh</option>
                                                        <option value="haji" @selected($paket->jenis_paket == 'haji')>Haji</option>
                                                        <option value="wisata_halal" @selected($paket->jenis_paket == 'wisata_halal')>Wisata Halal</option>
                                                    </select>
                                                    <x-form-error name="jenis_paket" />
                                                </div>

                                                <x-form-input label="Durasi (hari)" name="durasi" type="number" :value="$paket->durasi" placeholder="Durasi" />
                                                <x-form-error name="durasi" />

                                                <x-form-input label="Harga" name="harga" type="number" :value="$paket->harga" placeholder="Harga" />
                                                <x-form-error name="harga" />

                                                <x-form-input label="Kuota Jemaah (kosongkan jika tidak dibatasi)" name="kuota_jemaah" type="number" :value="$paket->kuota_jemaah" placeholder="Kuota Jemaah" />
                                                <x-form-error name="kuota_jemaah" />

                                                <x-form-input label="Tempat Keberangkatan" name="tempat_keberangkatan" :value="$paket->tempat_keberangkatan" placeholder="Tempat Keberangkatan" />
                                                <x-form-error name="tempat_keberangkatan" />

                                                <x-form-input label="Tempat Kepulangan" name="tempat_kepulangan" :value="$paket->tempat_kepulangan" placeholder="Tempat Kepulangan" />
                                                <x-form-error name="tempat_kepulangan" />

                                                <x-form-input label="Tanggal Mulai" name="tanggal_mulai" type="date" :value="$paket->tanggal_mulai" />
                                                <x-form-error name="tanggal_mulai" />

                                                <x-form-input label="Tanggal Selesai" name="tanggal_selesai" type="date" :value="$paket->tanggal_selesai" />
                                                <x-form-error name="tanggal_selesai" />

                                                <div class="mb-4">
                                                    <label for="fasilitas_{{ $paket->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Fasilitas</label>
                                                    <textarea id="fasilitas_{{ $paket->id }}" name="fasilitas" rows="6" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm">{{ $paket->fasilitas }}</textarea>
                                                    <x-form-error name="fasilitas" />
                                                </div>

                                                <div class="mb-4">
                                                    <label for="deskripsi_{{ $paket->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Deskripsi</label>
                                                    <textarea id="deskripsi_{{ $paket->id }}" name="deskripsi" rows="6" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm">{{ $paket->deskripsi }}</textarea>
                                                    <x-form-error name="deskripsi" />
                                                </div>

                                                <div class="mb-4">
                                                    <label for="gambar_{{ $paket->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                                                    <input type="file" id="gambar_{{ $paket->id }}" name="gambar" @change="preview($event)"
                                                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    <x-form-error name="gambar" />
                                                </div>

                                                <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                                                    <input type="checkbox" value="{{ now() }}" name="published_at" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($paket->published_at)>
                                                    Terbitkan?
                                                </label>
                                            </div>

                                            <div>
                                                <x-card title="Pratinjau Gambar">
                                                    <img :src="previewUrl || '{{ $paket->gambar ? asset('storage/' . $paket->gambar) : '' }}'" alt="" class="aspect-4/3 w-full rounded-lg object-cover">
                                                </x-card>
                                            </div>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-data-table>
@endsection

@section('script')
    <script>
        // Lazy-load the TinyMCE library only when an editor is first opened,
        // instead of downloading ~500KB from the CDN on every index page load.
        let _tinymceLoading = null;

        function loadTinyMCE() {
            if (window.tinymce) return Promise.resolve();
            if (_tinymceLoading) return _tinymceLoading;
            _tinymceLoading = new Promise((resolve, reject) => {
                const s = document.createElement('script');
                s.src = 'https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js';
                s.referrerPolicy = 'origin';
                s.onload = resolve;
                s.onerror = reject;
                document.head.appendChild(s);
            });
            return _tinymceLoading;
        }

        function initTinyMCE(selectorId) {
            loadTinyMCE().then(() => {
                if (!window.tinymce || tinymce.get(selectorId)) return;
                tinymce.init({
                    selector: '#' + selectorId,
                    height: 350,
                    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace wordcount visualblocks visualchars code fullscreen',
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                    license_key: 'gpl',
                });
            });
        }
    </script>
@endsection
