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

        <x-modal title="Tambah Hotel" maxWidth="max-w-4xl">
            <form action="/admin/hotel" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <x-form-input label="Kode Hotel" name="kode_hotel" placeholder="Kode Hotel" />
                        <x-form-error name="kode_hotel" />

                        <x-form-input label="Nama Hotel" name="nama_hotel" placeholder="Nama Hotel" />
                        <x-form-error name="nama_hotel" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Bintang</label>
                            <div class="flex flex-wrap gap-3">
                                @for ($i = 0; $i <= 7; $i++)
                                    <label class="flex items-center gap-1.5 text-sm text-stone-700">
                                        <input type="radio" name="bintang" value="{{ $i }}" class="text-maroon-700 focus:ring-maroon-400">
                                        {{ $i }}
                                    </label>
                                @endfor
                            </div>
                            <x-form-error name="bintang" />
                        </div>

                        <x-form-input label="Bintang Setaraf" name="bintang_setaraf" placeholder="Bintang Setaraf" />
                        <x-form-error name="bintang_setaraf" />

                        <x-form-input label="Kota" name="kota" placeholder="Kota" />
                        <x-form-error name="kota" />

                        <x-form-input label="Negara" name="negara" placeholder="Negara" />
                        <x-form-error name="negara" />

                        <x-form-textarea label="Alamat" name="alamat" placeholder="Alamat" />
                        <x-form-error name="alamat" />

                        <x-form-input label="Link Gmaps" name="link_gmaps" type="url" placeholder="Link Gmaps" />
                        <x-form-error name="link_gmaps" />

                        <x-form-textarea label="Deskripsi" name="deskripsi" placeholder="Deskripsi" />
                        <x-form-error name="deskripsi" />

                        <div class="mb-4">
                            <label for="gambar" class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                            <input type="file" id="gambar" name="gambar" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <x-form-error name="gambar" />
                        </div>
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

    <x-data-table searchPlaceholder="Cari hotel...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Nama Hotel</th>
                    <th class="px-4 py-3">Bintang</th>
                    <th class="px-4 py-3">Kota</th>
                    <th class="px-4 py-3">Negara</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($hotels as $hotel)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $hotel->kode_hotel }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $hotel->nama_hotel }}</td>
                        <td class="px-4 py-3 text-amber-500">
                            @for ($i = 0; $i < $hotel->bintang; $i++)
                                <i class="bx bxs-star"></i>
                            @endfor
                        </td>
                        <td class="px-4 py-3">{{ $hotel->kota }}</td>
                        <td class="px-4 py-3">{{ $hotel->negara }}</td>
                        <td class="px-4 py-3 text-stone-500">{{ $hotel->alamat }}</td>
                        <td class="px-4 py-3">
                            @if ($hotel->gambar)
                                <img src="{{ asset('storage/' . $hotel->gambar) }}" alt="{{ $hotel->nama_hotel }}" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/hotel/' . $hotel->id" />

                                <x-modal title="Edit Hotel" maxWidth="max-w-4xl">
                                    <form action="/admin/hotel/{{ $hotel->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <div class="lg:col-span-2">
                                                <x-form-input label="Kode Hotel" name="kode_hotel" :value="$hotel->kode_hotel" placeholder="Kode Hotel" />
                                                <x-form-error name="kode_hotel" />

                                                <x-form-input label="Nama Hotel" name="nama_hotel" :value="$hotel->nama_hotel" placeholder="Nama Hotel" />
                                                <x-form-error name="nama_hotel" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Bintang</label>
                                                    <div class="flex flex-wrap gap-3">
                                                        @for ($i = 0; $i <= 7; $i++)
                                                            <label class="flex items-center gap-1.5 text-sm text-stone-700">
                                                                <input type="radio" name="bintang" value="{{ $i }}" class="text-maroon-700 focus:ring-maroon-400" @checked($hotel->bintang == $i)>
                                                                {{ $i }}
                                                            </label>
                                                        @endfor
                                                    </div>
                                                    <x-form-error name="bintang" />
                                                </div>

                                                <x-form-input label="Bintang Setaraf" name="bintang_setaraf" :value="$hotel->bintang_setaraf" placeholder="Bintang Setaraf" />
                                                <x-form-error name="bintang_setaraf" />

                                                <x-form-input label="Kota" name="kota" :value="$hotel->kota" placeholder="Kota" />
                                                <x-form-error name="kota" />

                                                <x-form-input label="Negara" name="negara" :value="$hotel->negara" placeholder="Negara" />
                                                <x-form-error name="negara" />

                                                <x-form-textarea label="Alamat" name="alamat" :value="$hotel->alamat" placeholder="Alamat" />
                                                <x-form-error name="alamat" />

                                                <x-form-input label="Link Gmaps" name="link_gmaps" type="url" :value="$hotel->link_gmaps" placeholder="Link Gmaps" />
                                                <x-form-error name="link_gmaps" />

                                                <x-form-textarea label="Deskripsi" name="deskripsi" :value="$hotel->deskripsi" placeholder="Deskripsi" />
                                                <x-form-error name="deskripsi" />

                                                <div class="mb-4">
                                                    <label for="gambar_{{ $hotel->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Gambar</label>
                                                    <input type="file" id="gambar_{{ $hotel->id }}" name="gambar" @change="preview($event)"
                                                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    <x-form-error name="gambar" />
                                                </div>
                                            </div>

                                            <div>
                                                <x-card title="Pratinjau Gambar">
                                                    <img :src="previewUrl || '{{ $hotel->gambar ? asset('storage/' . $hotel->gambar) : '' }}'" alt="" class="aspect-4/3 w-full rounded-lg object-cover">
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
