@extends('layouts.main')

@section('content')
@php
    use Carbon\Carbon;
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
                <form method="POST" action="{{ route('pemesanan.store') }}" id="formPemesanan">
                    @csrf
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="jumlah_jemaah" value="0">
                    <!-- Form Jemaah -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="m-0"><i class='bx bx-user-circle'></i> Data Pemesan</h5>
                        </div>
                        <div class="card-body">
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
                            <div class="text-end">
                                <a href="/paket/{{ $paket->id }}"
                                                class="btn btn-sm btn-secondary mb-1"><i data-feather="arrow-left"
                                                    class="icon-sm me-2"></i>Kembali</a>
                                <button type="submit" class="btn default-btn btn-bg-two border-radius-5">
                                    <i class='bx bx-check-circle'></i> Lanjutkan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

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
@endsection