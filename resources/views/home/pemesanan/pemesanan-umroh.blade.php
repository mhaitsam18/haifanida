@extends('layouts.main')

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
        <div class="row">
            <div class="col-lg-8">
                <form method="POST" action="{{ route('pemesan.store') }}" id="formPemesanan">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    {{-- <input type="hidden" name="jumlah_orang" value="0"> --}}
                    <input type="hidden" name="tanggal_pesan" value="<?php echo htmlspecialchars($tanggalPemesanan); ?>">

                    <!-- Form Jemaah -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-user-circle'></i> Data Pemesan</h5>
                        </div>
                        <div class="card-body">

                            <!-- Checkbox apakah jemaah -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="isJemaah" name="is_jemaah" onchange="fillDataFromMember()">
                                <label class="form-check-label" for="isJemaah">
                                    Apakah Anda Jemaah?
                                </label>
                            </div>

                            <!-- Form Input -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ old('nama', $user->name ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Pemesan</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon"
                                    value="{{ old('telepon', $user->phone_number ?? '') }}" required>
                            </div>

                            <!-- Jumlah Jemaah -->
                            <div class="mb-4">
                                <label for="jumlah_orang" class="form-label">Jumlah Jemaah<span class="text-danger">*</span></label>
                                <input type="number" min="1" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                            </div>
                            <hr>
                            <h5>Pemesanan Kamar</h5>
                            <div id="kamar-container"></div>
                            <button type="button" class="btn btn-outline-primary mb-3" onclick="addKamarCard()">+ Tambah Kamar</button>

                            <h5>Pemesanan Ekstra</h5>
                            <div id="ekstra-container"></div>
                            <button type="button" class="btn btn-outline-primary mb-3" onclick="addEkstraCard()">+ Tambah Ekstra</button>
                            <div class="text-end">
                                <a href="/paket/{{ $paket->id }}" class="btn btn-sm btn-secondary mb-1">
                                    <i data-feather="arrow-left" class="icon-sm me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn default-btn btn-bg-two border-radius-5">
                                    <i class='bx bx-check-circle'></i> Lanjutkan
                                </button>
                            </div>
                        </div>
                        {{-- aku mau menambahkan card pemesanan kamar dan pemesanan ekstra dibawah ini --}}
                    </div>
                </form>

            <!-- Sidebar: Ringkasan Paket -->
            <div class="col-lg-4">
                <div class="sidebar-wrap sticky-top" style="top: 20px;">
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
    function fillDataFromMember() {
        const isChecked = document.getElementById('isJemaah').checked;

        if (isChecked) {
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
            document.getElementById('nama').value = '';
            document.getElementById('email').value = '';
            document.getElementById('telepon').value = '';
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
                        <select name="kamars[${kamarIndex}][tipe_kamar]" class="form-select" required>
                            <option value="">Pilih Tipe Kamar</option>
                            @foreach($kamars as $kamar)
                            <option value="{{ $kamar->nama_ekstra }}">{{ $kamar->nama_ekstra }} | Rp.{{ number_format($kamar->harga_default, 2, ',', '.') }} | {{ $kamar->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Jumlah Pengisi</label>
                        <input type="number" min="1" name="kamars[${kamarIndex}][jumlah_pengisi]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeCard('kamar-card-${kamarIndex}')">Hapus</button>
                </div>
            </div>
        `;
        document.getElementById('kamar-container').insertAdjacentHTML('beforeend', kamarCard);
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