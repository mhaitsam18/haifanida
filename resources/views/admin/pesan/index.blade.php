@extends('admin.layouts.app')

@section('content')
    <x-page-header :title="$title" />

    <div x-data="{ replyModal: false, id: '', nama_pengirim: '', email_pengirim: '', subjek: '', pesan: '' }">
        <x-data-table searchPlaceholder="Cari pesan...">
            <table class="w-full text-left text-sm">
                <thead class="bg-cream-100 text-xs uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nama Pengirim</th>
                        <th class="px-4 py-3">Email Pengirim</th>
                        <th class="px-4 py-3">Nomor WhatsApp</th>
                        <th class="px-4 py-3">Subjek</th>
                        <th class="px-4 py-3">Pesan</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    @foreach ($pesans as $pesan)
                        @php
                            $nomor_wa = preg_replace('/[^0-9]/', '', $pesan->nomor_wa_pengirim);
                            if (substr($nomor_wa, 0, 1) === '0') {
                                $nomor_wa = '+62' . substr($nomor_wa, 1);
                            }
                            $nomor_wa = str_replace(['(', ')', ' '], '', $nomor_wa);
                            $link_wa = 'https://wa.me/' . $nomor_wa;
                        @endphp
                        <tr x-show="q === '' || $el.innerText.toLowerCase().includes(q.toLowerCase())">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium text-stone-800">{{ $pesan->nama_pengirim }}</td>
                            <td class="px-4 py-3">{{ $pesan->email_pengirim }}</td>
                            <td class="px-4 py-3">{{ $pesan->nomor_wa_pengirim }}</td>
                            <td class="px-4 py-3">{{ $pesan->subjek }}</td>
                            <td class="px-4 py-3 text-stone-500">{{ Illuminate\Support\Str::limit($pesan->pesan, 60) }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ $link_wa }}" target="_blank" class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100">Balas via WA</a>
                                    <button type="button"
                                        @click="replyModal = true; id = '{{ $pesan->id }}'; nama_pengirim = '{{ addslashes($pesan->nama_pengirim) }}'; email_pengirim = '{{ addslashes($pesan->email_pengirim) }}'; subjek = '{{ addslashes($pesan->subjek) }}'; pesan = ''"
                                        class="rounded-md bg-maroon-50 px-2.5 py-1 text-xs font-medium text-maroon-700 hover:bg-maroon-100">
                                        Balas Email
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-data-table>

        <div x-show="replyModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
            <div @click.outside="replyModal = false" class="w-full max-w-lg rounded-2xl bg-cream-50 p-6 shadow-xl">
                <h3 class="font-display mb-4 text-lg font-semibold text-maroon-900">Balas Via Email</h3>
                <form action="/admin/pesan/kirim-email" method="post">
                    @csrf
                    <input type="hidden" name="id" :value="id">
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Kepada</label>
                        <input type="text" :value="nama_pengirim" readonly class="w-full rounded-lg border border-cream-300 bg-cream-100 px-3 py-2 text-sm text-stone-600">
                    </div>
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Email Tujuan</label>
                        <input type="text" name="email_pengirim" :value="email_pengirim" readonly class="w-full rounded-lg border border-cream-300 bg-cream-100 px-3 py-2 text-sm text-stone-600">
                    </div>
                    <input type="hidden" name="subjek" :value="subjek">
                    <div class="mb-4">
                        <label class="mb-1.5 block text-sm font-medium text-stone-700">Pesan</label>
                        <textarea name="pesan" x-model="pesan" rows="4" class="w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="replyModal = false" class="rounded-lg border border-cream-300 px-4 py-2 text-sm font-semibold text-stone-600 hover:bg-cream-100">Tutup</button>
                        <x-button type="submit">Kirim</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
