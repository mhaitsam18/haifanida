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

        <x-modal title="Tambah Author" maxWidth="max-w-4xl">
            <form action="/admin/author" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <x-form-input label="Nama Lengkap / Nama Pena" name="name" placeholder="Nama Lengkap / Nama Pena" />
                        <x-form-error name="name" />

                        <div class="avail-wrap">
                            <x-form-input label="Email" name="email" type="email" placeholder="Email" class="js-check-email" />
                            <p class="availability-result -mt-3 mb-3 text-xs"></p>
                        </div>
                        <x-form-error name="email" />

                        <div class="avail-wrap">
                            <x-form-input label="Username" name="username" placeholder="Username" class="js-check-username" />
                            <p class="availability-result -mt-3 mb-3 text-xs"></p>
                        </div>
                        <x-form-error name="username" />

                        <x-form-input label="Nomor Ponsel" name="phone_number" placeholder="Nomor Ponsel" />
                        <x-form-error name="phone_number" />

                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                            <input type="file" id="photo" name="photo" @change="preview($event)"
                                class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                            <x-form-error name="photo" />
                        </div>

                        <x-form-input label="Kata Sandi" name="password" type="password" placeholder="Kata Sandi" />
                        <x-form-error name="password" />

                        <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />
                    </div>

                    <div>
                        <x-card title="Pratinjau Foto">
                            <img x-show="previewUrl" :src="previewUrl" alt="" class="aspect-square w-full rounded-lg object-cover">
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

    <x-data-table searchPlaceholder="Cari author...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Nomor Ponsel</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($authors as $author)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $author->user->name }}</td>
                        <td class="px-4 py-3">{{ $author->user->email }}</td>
                        <td class="px-4 py-3">{{ $author->user->username }}</td>
                        <td class="px-4 py-3">{{ $author->user->phone_number }}</td>
                        <td class="px-4 py-3">
                            @if ($author->user->photo)
                                <img src="{{ asset('storage/' . $author->user->photo) }}" alt="Foto" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/author/' . $author->id" />

                                <x-modal title="Edit Author" maxWidth="max-w-4xl">
                                    <form action="/admin/author/{{ $author->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <div class="grid gap-6 lg:grid-cols-3">
                                            <div class="lg:col-span-2">
                                                <x-form-input label="Nama Lengkap / Nama Pena" name="name" :value="$author->user->name" placeholder="Nama Lengkap / Nama Pena" />
                                                <x-form-error name="name" />

                                                <div class="avail-wrap">
                                                    <x-form-input label="Email" name="email" type="email" :value="$author->user->email" placeholder="Email" class="js-check-email" />
                                                    <p class="availability-result -mt-3 mb-3 text-xs"></p>
                                                </div>
                                                <x-form-error name="email" />

                                                <div class="avail-wrap">
                                                    <x-form-input label="Username" name="username" :value="$author->user->username" placeholder="Username" class="js-check-username" />
                                                    <p class="availability-result -mt-3 mb-3 text-xs"></p>
                                                </div>
                                                <x-form-error name="username" />

                                                <x-form-input label="Nomor Ponsel" name="phone_number" :value="$author->user->phone_number" placeholder="Nomor Ponsel" />
                                                <x-form-error name="phone_number" />

                                                <div class="mb-4">
                                                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                                                    <input type="file" id="photo_{{ $author->id }}" name="photo" @change="preview($event)"
                                                        class="block w-full text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                                    <x-form-error name="photo" />
                                                </div>

                                                <x-form-input label="Kata Sandi Baru" name="password" type="password" placeholder="Kata Sandi Baru" />
                                                <x-form-error name="password" />

                                                <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />
                                            </div>

                                            <div>
                                                <x-card title="Pratinjau Foto">
                                                    <img :src="previewUrl || '{{ $author->user->photo ? asset('storage/' . $author->user->photo) : '' }}'" alt="" class="aspect-square w-full rounded-lg object-cover">
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
        document.addEventListener('DOMContentLoaded', function () {
            function checkAvailability(input, urlPrefix, label) {
                if (!input.value) return;
                const wrap = input.closest('.avail-wrap');
                const resultEl = wrap ? wrap.querySelector('.availability-result') : null;
                fetch(urlPrefix + '/' + encodeURIComponent(input.value), { headers: { 'Accept': 'application/json' } })
                    .then(response => response.json())
                    .then(data => {
                        if (!resultEl) return;
                        const available = data.status === 'available';
                        resultEl.textContent = available ? label + ' tersedia' : label + ' sudah digunakan';
                        resultEl.style.color = available ? '#15803d' : '#dc2626';
                    });
            }

            document.addEventListener('input', function (e) {
                if (e.target.matches('.js-check-username')) {
                    checkAvailability(e.target, '/check-username', 'Username');
                }
                if (e.target.matches('.js-check-email')) {
                    checkAvailability(e.target, '/check-email', 'Email');
                }
            });
        });
    </script>
@endsection
