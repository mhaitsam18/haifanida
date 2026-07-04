@extends('layouts.app')

@section('content')
    @php
        use Carbon\Carbon;
        $tanggalPemesanan = Carbon::now()->toDateString();
    @endphp

    <div class="border-b border-cream-200 bg-cream-50">
        <div class="mx-auto max-w-6xl px-4 py-4 text-sm text-stone-500">
            <a href="/" class="hover:text-maroon-700">Beranda</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <a href="/umroh" class="hover:text-maroon-700">Paket Umroh</a>
            <i class="bx bx-chevron-right mx-1 align-middle"></i>
            <span class="text-stone-700">Form Pemesanan</span>
        </div>
    </div>

    <section class="py-10">
        <div class="mx-auto max-w-6xl px-4">
            <h1 class="font-display mb-8 text-2xl font-semibold text-maroon-900">Form Pemesanan {{ $paket->nama_paket }}</h1>

            <div class="grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <form method="POST" action="{{ route('pemesan.store') }}" id="formPemesanan">
                        @csrf
                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="tanggal_pesan" value="{{ $tanggalPemesanan }}">

                        <x-card class="mb-5">
                            <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                                <i class="bx bx-user-circle"></i> Data Pemesan
                            </h3>
                            <x-form-input label="Nama Pemesan" name="nama" :value="$user->name ?? ''" required />
                            <x-form-input label="Email Pemesan" name="email" type="email" :value="$user->email ?? ''" required />
                            <x-form-input label="Nomor Telepon" name="telepon" :value="$user->phone_number ?? ''" required />
                            <hr class="my-4 border-cream-200">
                            <x-form-input label="Jumlah Jemaah" name="jumlah_orang" type="number" min="1" required />
                        </x-card>

                        <x-card class="mb-5">
                            <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                                <i class="bx bx-building-house"></i> Pemesanan Kamar
                            </h3>
                            <div id="kamar-container" class="space-y-3"></div>
                            <button type="button" onclick="addKamarCard()" class="mt-2 inline-flex items-center gap-1.5 rounded-lg border border-maroon-300 px-4 py-2 text-sm font-medium text-maroon-700 hover:bg-maroon-50">
                                <i class="bx bx-plus"></i> Tambah Kamar
                            </button>
                        </x-card>

                        <x-card class="mb-5">
                            <h3 class="font-display mb-4 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                                <i class="bx bx-plus-circle"></i> Pemesanan Ekstra
                            </h3>
                            <div id="ekstra-container" class="space-y-3"></div>
                            <button type="button" onclick="addEkstraCard()" class="mt-2 inline-flex items-center gap-1.5 rounded-lg border border-maroon-300 px-4 py-2 text-sm font-medium text-maroon-700 hover:bg-maroon-50">
                                <i class="bx bx-plus"></i> Tambah Ekstra
                            </button>
                        </x-card>

                        <div class="flex justify-end gap-3">
                            <x-button variant="secondary" href="/paket/{{ $paket->id }}">
                                <i class="bx bx-arrow-back"></i> Kembali
                            </x-button>
                            <x-button type="submit">
                                <i class="bx bx-check-circle"></i> Lanjutkan
                            </x-button>
                        </div>
                    </form>
                </div>

                <div>
                    <div class="sticky top-24">
                        <x-card>
                            <h3 class="font-display mb-3 flex items-center gap-2 text-lg font-semibold text-maroon-900">
                                <i class="bx bx-package"></i> Ringkasan Paket
                            </h3>
                            <h4 class="font-medium text-stone-800">{{ $paket->nama_paket }}</h4>
                            <div class="mt-3 flex items-center gap-3">
                                <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}" class="h-20 w-20 rounded-lg object-cover">
                                <div class="text-sm text-stone-600">
                                    <p class="flex items-center gap-1.5"><i class="bx bx-map"></i> {{ $paket->destinasi }}</p>
                                    <p class="mt-1 flex items-center gap-1.5"><i class="bx bx-calendar"></i> {{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</p>
                                    <p class="mt-1 flex items-center gap-1.5"><i class="bx bx-time"></i> {{ $paket->durasi }} Hari</p>
                                </div>
                            </div>
                            <div class="mt-4 space-y-2 border-t border-cream-200 pt-4 text-sm">
                                <div class="flex justify-between"><span class="text-stone-500">Berangkat dari:</span><span class="font-medium text-stone-800">{{ $paket->tempat_keberangkatan }}</span></div>
                                <div class="flex justify-between"><span class="text-stone-500">Tanggal Berangkat:</span><span class="font-medium text-stone-800">{{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</span></div>
                                <div class="flex justify-between"><span class="text-stone-500">Tanggal Pulang:</span><span class="font-medium text-stone-800">{{ Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</span></div>
                            </div>
                        </x-card>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        let kamarIndex = 0;
        let ekstraIndex = 0;

        const kamarInputClass = 'w-full rounded-lg border border-cream-300 px-3 py-2 text-sm focus:border-maroon-400 focus:outline-none focus:ring-2 focus:ring-maroon-100';

        function addKamarCard() {
            kamarIndex++;
            const kamarCard = document.createElement('div');
            kamarCard.className = 'rounded-lg border border-cream-200 p-4';
            kamarCard.id = `kamar-card-${kamarIndex}`;
            kamarCard.innerHTML = `
                <div class="mb-2">
                    <label class="mb-1 block text-sm font-medium text-stone-700">Tipe Kamar</label>
                    <select name="kamars[${kamarIndex}][tipe_kamar]" class="${kamarInputClass}" onchange="updateJumlahPengisi(this, ${kamarIndex})" required>
                        <option value="">Pilih Tipe Kamar</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->nama_ekstra }}" data-keterangan="{{ $kamar->keterangan }}">{{ $kamar->nama_ekstra }} | Rp.{{ number_format($kamar->harga_default, 2, ',', '.') }} | {{ $kamar->keterangan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="mb-1 block text-sm font-medium text-stone-700">Jumlah Pengisi</label>
                    <input type="number" min="1" id="jumlah-pengisi-${kamarIndex}" name="kamars[${kamarIndex}][jumlah_pengisi]" class="${kamarInputClass}" required>
                </div>
                <button type="button" onclick="removeCard('kamar-card-${kamarIndex}')" class="rounded-md bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 hover:bg-red-100">Hapus</button>
            `;
            document.getElementById('kamar-container').appendChild(kamarCard);
        }

        function updateJumlahPengisi(selectElement, index) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const keterangan = selectedOption.getAttribute('data-keterangan');
            const inputPengisi = document.getElementById(`jumlah-pengisi-${index}`);

            if (!keterangan) {
                inputPengisi.min = 1;
                inputPengisi.removeAttribute('max');
                inputPengisi.readOnly = false;
                inputPengisi.value = '';
                return;
            }

            inputPengisi.readOnly = false;
            inputPengisi.removeAttribute('max');

            let match = keterangan.match(/harus diisi (\d+) orang/);
            if (match) {
                inputPengisi.min = match[1];
                inputPengisi.max = match[1];
                inputPengisi.value = match[1];
                inputPengisi.readOnly = true;
                return;
            }

            match = keterangan.match(/dapat diisi 1 s\/d (\d+) orang/);
            if (match) {
                inputPengisi.min = 1;
                inputPengisi.max = match[1];
                inputPengisi.value = 1;
                return;
            }

            match = keterangan.match(/(?:hanya dapat|dapat) diisi (\d+) orang/);
            if (match) {
                inputPengisi.min = match[1];
                inputPengisi.max = match[1];
                inputPengisi.value = match[1];
                inputPengisi.readOnly = true;
            }
        }

        function addEkstraCard() {
            ekstraIndex++;
            const ekstraCard = document.createElement('div');
            ekstraCard.className = 'rounded-lg border border-cream-200 p-4';
            ekstraCard.id = `ekstra-card-${ekstraIndex}`;
            ekstraCard.innerHTML = `
                <div class="mb-2">
                    <label class="mb-1 block text-sm font-medium text-stone-700">Jenis Ekstra</label>
                    <select name="ekstras[${ekstraIndex}][ekstra]" class="${kamarInputClass}" required>
                        <option value="">Pilih Ekstra</option>
                        @foreach ($ekstras as $ekstra)
                            <option value="{{ $ekstra->nama_ekstra }}">{{ $ekstra->nama_ekstra }} | Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="mb-1 block text-sm font-medium text-stone-700">Jumlah Ekstra</label>
                    <input type="number" min="1" name="ekstras[${ekstraIndex}][jumlah]" class="${kamarInputClass}" required>
                </div>
                <button type="button" onclick="removeCard('ekstra-card-${ekstraIndex}')" class="rounded-md bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 hover:bg-red-100">Hapus</button>
            `;
            document.getElementById('ekstra-container').appendChild(ekstraCard);
        }

        function removeCard(id) {
            document.getElementById(id).remove();
        }

        document.getElementById('formPemesanan').addEventListener('submit', function (event) {
            const jumlahJemaah = parseInt(document.getElementById('jumlah_orang').value, 10) || 0;

            let totalPengisiKamar = 0;
            const listPengisiKamar = document.querySelectorAll('input[name^="kamars["][name$="][jumlah_pengisi]"]');
            listPengisiKamar.forEach(input => {
                totalPengisiKamar += parseInt(input.value, 10) || 0;
            });

            if (jumlahJemaah !== totalPengisiKamar) {
                event.preventDefault();
                alert(`Total pengisi kamar (${totalPengisiKamar}) tidak sesuai dengan jumlah jemaah yang didaftarkan (${jumlahJemaah}). Mohon periksa kembali.`);
            }
        });
    </script>
@endsection
