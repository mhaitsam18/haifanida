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

        <x-modal title="Tambah Admin" maxWidth="max-w-2xl">
            <form action="/admin/user-admin" method="post" enctype="multipart/form-data" @submit="submit">
                @csrf
                <input type="hidden" name="role" value="admin">

                <x-form-input label="Nama" name="name" placeholder="Nama" />
                <x-form-error name="name" />

                <x-form-input label="Email" name="email" type="email" placeholder="Email" class="js-check-email" />
                <x-form-error name="email" />
                <p class="js-email-availability -mt-3 mb-3 text-xs"></p>

                <x-form-input label="Username" name="username" placeholder="Username" class="js-check-username" />
                <x-form-error name="username" />
                <p class="js-username-availability -mt-3 mb-3 text-xs"></p>

                <x-form-input label="Nomor Ponsel" name="phone_number" placeholder="Nomor Ponsel" />
                <x-form-error name="phone_number" />

                <div class="mb-4">
                    <label for="kantor_id" class="mb-1.5 block text-sm font-medium text-stone-700">Kantor</label>
                    <select id="kantor_id" name="kantor_id"
                        class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                        <option value="" selected>Pilih Kantor</option>
                        @foreach ($kantors as $kantor)
                            <option value="{{ $kantor->id }}">{{ $kantor->nama_kantor }}</option>
                        @endforeach
                    </select>
                    <x-form-error name="kantor_id" />
                </div>

                <div class="mb-4">
                    <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                    <div class="flex items-center gap-4">
                        <img x-show="previewUrl" :src="previewUrl" class="h-16 w-16 rounded-full border border-cream-200 object-cover">
                        <input type="file" name="photo" @change="preview($event)"
                            class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                    </div>
                    <x-form-error name="photo" />
                </div>

                <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                    <input type="checkbox" value="1" name="is_superadmin" class="rounded text-maroon-700 focus:ring-maroon-400">
                    SuperAdmin?
                </label>

                <x-form-input label="Kata Sandi" name="password" type="password" placeholder="Kata Sandi" />
                <x-form-error name="password" />

                <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />

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

    <x-data-table searchPlaceholder="Cari admin...">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Nomor Ponsel</th>
                    <th class="px-4 py-3">SuperAdmin?</th>
                    <th class="px-4 py-3">Kantor</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cream-200">
                @foreach ($admins as $admin)
                    <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-stone-800">{{ $admin->user->name }}</td>
                        <td class="px-4 py-3">{{ $admin->user->email }}</td>
                        <td class="px-4 py-3">{{ $admin->user->username }}</td>
                        <td class="px-4 py-3">{{ $admin->user->phone_number }}</td>
                        <td class="px-4 py-3">
                            @if ($admin->is_superadmin)
                                <x-badge variant="success"><i class="bx bx-check"></i></x-badge>
                            @else
                                <x-badge variant="danger"><i class="bx bx-x"></i></x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $admin->kantor->nama_kantor ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if ($admin->user->photo)
                                <img src="{{ asset('storage/' . $admin->user->photo) }}" alt="Foto" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <span class="text-xs text-stone-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2" x-data="modalForm()">
                                <button type="button" @click="show()" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Edit</button>
                                <x-delete-form :action="'/admin/user-admin/' . $admin->id" />

                                <x-modal title="Edit Admin" maxWidth="max-w-2xl">
                                    <form action="/admin/user-admin/{{ $admin->id }}" method="post" enctype="multipart/form-data" @submit="submit">
                                        @method('put')
                                        @csrf
                                        <x-form-input label="Nama" name="name" :value="$admin->user->name" placeholder="Nama" />
                                        <x-form-error name="name" />

                                        <x-form-input label="Email" name="email" type="email" :value="$admin->user->email" placeholder="Email" class="js-check-email" />
                                        <x-form-error name="email" />
                                        <p class="js-email-availability -mt-3 mb-3 text-xs"></p>

                                        <x-form-input label="Username" name="username" :value="$admin->user->username" placeholder="Username" class="js-check-username" />
                                        <x-form-error name="username" />
                                        <p class="js-username-availability -mt-3 mb-3 text-xs"></p>

                                        <x-form-input label="Nomor Ponsel" name="phone_number" :value="$admin->user->phone_number" placeholder="Nomor Ponsel" />
                                        <x-form-error name="phone_number" />

                                        <div class="mb-4">
                                            <label for="kantor_id_{{ $admin->id }}" class="mb-1.5 block text-sm font-medium text-stone-700">Kantor</label>
                                            <div class="flex gap-2">
                                                <select id="kantor_id_{{ $admin->id }}" name="kantor_id"
                                                    class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100">
                                                    <option value="" selected>Pilih Kantor</option>
                                                    @foreach ($kantors as $kantor)
                                                        <option value="{{ $kantor->id }}" @selected($kantor->id == $admin->kantor_id)>{{ $kantor->nama_kantor }}</option>
                                                    @endforeach
                                                </select>
                                                <x-button variant="secondary" href="/admin/kantor/{{ $admin->kantor_id }}/edit" class="shrink-0">Edit Kantor</x-button>
                                            </div>
                                            <x-form-error name="kantor_id" />
                                        </div>

                                        <div class="mb-4">
                                            <label class="mb-1.5 block text-sm font-medium text-stone-700">Foto</label>
                                            <div class="flex items-center gap-4">
                                                <img :src="previewUrl || '{{ $admin->user->photo ? asset('storage/' . $admin->user->photo) : '' }}'" class="h-16 w-16 rounded-full border border-cream-200 object-cover">
                                                <input type="file" name="photo" @change="preview($event)"
                                                    class="block flex-1 text-sm text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                            </div>
                                            <x-form-error name="photo" />
                                        </div>

                                        <label class="mb-4 flex items-center gap-2 text-sm text-stone-700">
                                            <input type="checkbox" value="1" name="is_superadmin" class="rounded text-maroon-700 focus:ring-maroon-400" @checked($admin->is_superadmin)>
                                            SuperAdmin?
                                        </label>

                                        <x-form-input label="Kata Sandi Baru" name="password" type="password" placeholder="Kata Sandi Saat Ini" />
                                        <x-form-error name="password" />

                                        <x-form-input label="Konfirmasi Kata Sandi" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" />

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

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function checkAvailability(input, urlPrefix, label, resultEl) {
                input.addEventListener('input', function () {
                    if (!this.value) return;
                    fetch(urlPrefix + '/' + encodeURIComponent(this.value), { headers: { 'Accept': 'application/json' } })
                        .then(response => response.json())
                        .then(data => {
                            const available = data.status === 'available';
                            resultEl.textContent = available ? label + ' tersedia' : label + ' sudah digunakan';
                            resultEl.style.color = available ? '#15803d' : '#dc2626';
                        });
                });
            }

            document.querySelectorAll('.js-check-username').forEach(function (input) {
                const resultEl = input.closest('form').querySelector('.js-username-availability');
                if (resultEl) checkAvailability(input, '/check-username', 'Username', resultEl);
            });
            document.querySelectorAll('.js-check-email').forEach(function (input) {
                const resultEl = input.closest('form').querySelector('.js-email-availability');
                if (resultEl) checkAvailability(input, '/check-email', 'Email', resultEl);
            });
        });
    </script>
@endsection
