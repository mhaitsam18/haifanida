@extends('layouts.main')

@section('content')

    <div class="section-title text-center">
        <h2>Perjalanan Saya</h2>
    </div>
    
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="card col-md-6" style="width: 50rem">
                <div class="card-body">
                    <div class="card-header">
                        <h3>NAMA PAKET</h3>
                    </div>
                    <div class="d-flex align-items-start m-3">
                        <img src="{{ asset('storage/paket-gambar/umroh-24.jpg') }}" alt="Foto Paketnya di Sini" class="me-3"
                        style="width: 200px; height: auto; border-radius: 8px;">
                        <div class="container">
                            <p>Jumlah Orang: 2 Orang</p>
                            <p>Tanggal Keberangkatan: 31 Mei 2025</p>
                            <p>Tanggal Kepulangan: 7 Juni 2025</p>
                        </div>
                    </div>
                    <!-- MODIFIED-- -->
                    <div class="d-flex bd-highlight justify-content-end align-items-center mt-3">
                        <!-- Notifikasi status apabila terdapat berkas yang belum diverifikasi dan/atau tagihan yang belum lunas -->
                        <p class="me-auto bd-highlight text-muted">Terdapat Berkas yang belum terverifikasi</p>

                        <a href="#" class="bd-highlight btn btn-primary">Verifikasi Berkas</a>
                        <a href="#" class="bd-highlight btn btn-primary ms-2 disabled"">Tagihan Lunas</a>
                    </div>
                    <!-- --MODIFIED -->
                </div>
            </div>

            <div class="card col-md-6 mt-3" style="width: 50rem">
                <div class="card-body">
                    <div class="card-header">
                        <h3>NAMA PAKET</h3>
                    </div>
                    <div class="d-flex align-items-start m-3">
                        <img src="{{ asset('storage/paket-gambar/umroh-24.jpg') }}" alt="Foto Paketnya di Sini" class="me-3"
                        style="width: 200px; height: auto; border-radius: 8px;">
                        <div class="container">
                            <p>Jumlah Orang: 2 Orang</p>
                            <p>Tanggal Keberangkatan: 31 Mei 2025</p>
                            <p>Tanggal Kepulangan: 7 Juni 2025</p>
                        </div>
                    </div>
                    <!-- MODIFIED-- -->
                    <div class="d-flex bd-highlight justify-content-end align-items-center mt-3">
                        <!-- Notifikasi status apabila terdapat berkas yang belum diverifikasi dan/atau tagihan yang belum lunas -->
                        <p class="me-auto bd-highlight text-muted">Terdapat Tagihan yang belum dilunasi</p>

                        <a href="#" class="bd-highlight btn btn-primary disabled">Berkas terverifikasi</a>
                        <!-- MODIFIED-- -->

                        <!-- <a href="#" class="bd-highlight btn btn-primary ms-2"">Tagihan belum lunas</a> -->
                        <a href="/member/tagihan" class="bd-highlight btn btn-primary ms-2"">Tagihan belum lunas</a>

                        <!-- --MODIFIED -->
                    </div>
                    <!-- --MODIFIED -->
                </div>
            </div>
        </div>
    </div>

@endsection