@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/form-pemesanan.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
    $tanggalPemesanan = Carbon::now()->toDateString();
@endphp
<div class="inner-banner">
    <div class="container">
        <div class="inner-title text-center">
            <h3>Form Pemesanan {{ $paket->nama_paket }}</h3>
            <ul>
                <li><a href="/home">Beranda</a></li>
                <li><i class='bx bx-chevrons-right'></i></li>
                <li><a href="/umroh">Paket Umroh</a></li>
                <li><i class='bx bx-chevrons-right'></i></li>
                <li>Form Pemesanan</li>
            </ul>
        </div>
    </div>
    <div class="inner-shape">
        <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Gambar">
    </div>
</div>

<div class="booking-area pt-100 pb-70">
    <div class="container">
        <div class="row align-items-start">
            <!-- Left Column: Data Pemesan, Pemesanan Kamar, Pemesanan Ekstra -->
            <div class="col-8 col-md-8 col-lg-8">
                <form method="POST" action="{{ route('pemesan.store') }}" id="formPemesanan">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="tanggal_pesan" value="<?php echo htmlspecialchars($tanggalPemesanan); ?>">
                    <!-- Card 1: Data Pemesan -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-user-circle'></i> Data Pemesan</h5>
                        </div>
                        <div class="card-body">
                            <!-- Form Input: Personal Info -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->name ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Pemesan</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $user->phone_number ?? '') }}" required>
                            </div>

                            <!-- Separator Line -->
                            <hr class="my-4" style="border-top: 1px solid #e2e8f0;">

                            <!-- Jumlah Jemaah -->
                            <div class="mb-4">
                                <label for="jumlah_orang" class="form-label">Jumlah Jemaah<span class="text-danger">*</span></label>
                                <input type="number" min="1" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                            </div>

                            <!-- Checkbox apakah jemaah -->
                            {{-- <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="isJemaah" name="is_jemaah" onchange="fillDataFromMember()">
                                <label class="form-check-label" for="isJemaah">
                                    Pemesan adalah Jemaah?
                                </label>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Card 2: Pemesanan Kamar -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-building'></i> Pemesanan Kamar</h5>
                        </div>
                        <div class="card-body">
                            <div id="kamar-container"></div>
                            <button type="button" class="btn btn-outline-primary mb-3" onclick="addKamarCard()">+ Tambah Kamar</button>
                        </div>
                    </div>

                    <!-- Card 3: Pemesanan Ekstra -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-plus-circle'></i> Pemesanan Ekstra</h5>
                        </div>
                        <div class="card-body">
                            <div id="ekstra-container"></div>
                            <button type="button" class="btn btn-outline-primary mb-3" onclick="addEkstraCard()">+ Tambah Ekstra</button>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                        <a href="/paket/{{ $paket->id }}" class="btn default-btn btn-bg-two border-radius-5 btn-back">
                            <i data-feather="arrow-left" class="icon-sm me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn default-btn btn-bg-two border-radius-5 btn-continue">
                            <i class='bx bx-check-circle'></i> Lanjutkan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Ringkasan Paket -->
            <div class="col-4 col-md-4 col-lg-4">
                <div class="sidebar-wrap" style="position: sticky; top: 90px; z-index: 10;">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-package'></i> Ringkasan Paket</h5>
                        </div>
                        <div class="card-body">
                            <h4>{{ $paket->nama_paket }}</h4>
                            <div class="d-flex align-items-center my-3">
                                <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}" class="img-fluid rounded me-2" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                <div>
                                    <p class="mb-1"><i class='bx bx-map'></i> {{ $paket->destinasi }}</p>
                                    <p class="mb-1"><i class='bx bx-calendar'></i> {{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</p>
                                    <p class="mb-0"><i class='bx bx-time'></i> {{ $paket->durasi }} Hari</p>
                                </div>
                            </div>
                            <div class="border-top pt-3 mt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Berangkat dari:</span>
                                    <span class="fw-bold">{{ $paket->tempat_keberangkatan }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tanggal Berangkat:</span>
                                    <span class="fw-bold">{{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tanggal Pulang:</span>
                                    <span class="fw-bold">{{ Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simpan data user asli saat halaman dimuat
let originalUserData = {
    nama: '',
    email: '',
    telepon: ''
};

// Inisialisasi data asli saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Simpan data user asli
    originalUserData.nama = document.getElementById('nama').value;
    originalUserData.email = document.getElementById('email').value;
    originalUserData.telepon = document.getElementById('telepon').value;
});

function fillDataFromMember() {
    const isChecked = document.getElementById('isJemaah').checked;

    if (isChecked) {
        // Jika checkbox dicentang, isi dengan data member atau user
        @if(isset($member))
            document.getElementById('nama').value = @json($member->nama_lengkap);
            document.getElementById('email').value = @json($member->email);
            document.getElementById('telepon').value = @json($member->nomor_telepon);
        @else
            document.getElementById('nama').value = @json($user->name);
            document.getElementById('email').value = @json($user->email);
            document.getElementById('telepon').value = @json($user->phone_number);
        @endif
    } else {
        // Jika checkbox tidak dicentang, kembalikan ke data user asli
        document.getElementById('nama').value = originalUserData.nama;
        document.getElementById('email').value = originalUserData.email;
        document.getElementById('telepon').value = originalUserData.telepon;
    }
}
    let kamarIndex = 0;
    let ekstraIndex = 0;

    function addKamarCard() {
        kamarIndex++;
        const kamarCard = `
            <div class="card mb-2" id="kamar-card-${kamarIndex}">
                <div class="card-body">
                    <div class="mb-2">
                        <label>Tipe Kamar</label>
                        <select name="kamars[${kamarIndex}][tipe_kamar]" class="form-select" onchange="updateJumlahPengisi(this, ${kamarIndex})" required>
                            <option value="">Pilih Tipe Kamar</option>
                            @foreach($kamars as $kamar)
                            <option value="{{ $kamar->nama_ekstra }}" data-keterangan="{{ $kamar->keterangan }}">{{ $kamar->nama_ekstra }} | Rp.{{ number_format($kamar->harga_default, 2, ',', '.') }} | {{ $kamar->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Jumlah Pengisi</label>
                        <input type="number" min="1" id="jumlah-pengisi-${kamarIndex}" name="kamars[${kamarIndex}][jumlah_pengisi]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeCard('kamar-card-${kamarIndex}')">Hapus</button>
                </div>
            </div>
        `;
        document.getElementById('kamar-container').insertAdjacentHTML('beforeend', kamarCard);
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

        // Reset state
        inputPengisi.readOnly = false;
        inputPengisi.removeAttribute('max');

        // Pola untuk "harus diisi X orang"
        let match = keterangan.match(/harus diisi (\d+) orang/);
        if (match) {
            const jumlah = match[1];
            inputPengisi.min = jumlah;
            inputPengisi.max = jumlah;
            inputPengisi.value = jumlah;
            inputPengisi.readOnly = true;
            return;
        }

        // Pola untuk "dapat diisi 1 s/d X orang"
        match = keterangan.match(/dapat diisi 1 s\/d (\d+) orang/);
        if (match) {
            const maxJumlah = match[1];
            inputPengisi.min = 1;
            inputPengisi.max = maxJumlah;
            inputPengisi.value = 1; // Set default value to min
            return;
        }

        // Pola untuk "hanya dapat diisi X orang" atau "dapat diisi X orang"
        match = keterangan.match(/(?:hanya dapat|dapat) diisi (\d+) orang/);
        if (match) {
            const jumlah = match[1];
            inputPengisi.min = jumlah;
            inputPengisi.max = jumlah;
            inputPengisi.value = jumlah;
            inputPengisi.readOnly = true;
        }
    }

    function addEkstraCard() {
        ekstraIndex++;
        const ekstraCard = `
            <div class="card mb-2" id="ekstra-card-${ekstraIndex}">
                <div class="card-body">
                    <div class="mb-2">
                        <label>Jenis Ekstra</label>
                        <select name="ekstras[${ekstraIndex}][ekstra]" class="form-select" required>
                            <option value="">Pilih Ekstra</option>
                            @foreach($ekstras as $ekstra)
                            <option value="{{ $ekstra->nama_ekstra }}">{{ $ekstra->nama_ekstra }} | Rp.{{ number_format($ekstra->harga_default, 2, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Jumlah Ekstra</label>
                        <input type="number" min="1" name="ekstras[${ekstraIndex}][jumlah]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeCard('ekstra-card-${ekstraIndex}')">Hapus</button>
                </div>
            </div>
        `;
        document.getElementById('ekstra-container').insertAdjacentHTML('beforeend', ekstraCard);
    }

    function removeCard(id) {
        document.getElementById(id).remove();
    }
</script>
@endsection

                            {{-- <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                    <select class="form-select @error('metode_pembayaran') is-invalid @enderror" id="metode_pembayaran" name="metode_pembayaran" required>
                                        <option value="" selected disabled>Pilih Metode Pembayaran</option>
                                        <option value="Transfer Bank" @selected(old('metode_pembayaran') == 'Transfer Bank')>Transfer Bank</option>
                                        <option value="Kartu Kredit" @selected(old('metode_pembayaran') == 'Kartu Kredit')>Kartu Kredit</option>
                                        <option value="Cash" @selected(old('metode_pembayaran') == 'Cash')>Cash</option>
                                    </select>
                                    @error('metode_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div> --}}