@extends('layouts.main')

@section('content')

    <div class="section-title text-center">
        <h2>Perjalanan Saya</h2>
    </div>
    @if($pemesanan)
    <div class="container">
        @foreach($pemesanan as $item)
        <div class="row justify-content-center my-5">
            <div class="card col-md-6" style="width: 54rem">
                <div class="card-body">
                    <div class="card-header">
                        <!-- MODIFIED-- -->
                        <h3>{{ $item->paket->nama_paket }}</h3>
                        <!-- --MODIFIED -->
                    </div>
                    <div class="d-flex align-items-start m-3">
                        <img src="{{ asset('storage/paket-gambar/umroh-24.jpg') }}" alt="Foto Paketnya di Sini" class="me-3"
                        style="width: 250px; height: auto; border-radius: 8px;">
                        <div class="container">
                            <!-- MODIFIED-- -->
                            <!-- MODIFIED-- -->
                            @php
                                $departure = \Carbon\Carbon::parse($item->paket->tanggal_mulai);
                                $sisa_hari = \Carbon\Carbon::now()->diffInDays($departure, false);
                            @endphp
                            @if ($sisa_hari > 0)
                                <h3 class="mb-1">Berangkat {{ $sisa_hari }} hari lagi</h3>
                            @elseif($sisa_hari === 0)
                                <h3 class="mb-1">Berangkat hari ini</h3>
                            @elseif($sisa_hari < 0)
                                <h3 class="mb-1">Sudah berangkat {{ abs($sisa_hari) }} hari yang lalu</h3>
                            @endif
                            <!-- MODIFIED-- -->
                            <!-- <p>Tanggal Keberangkatan: {{ \Carbon\Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }}</p>
                            <p>Tanggal Kepulangan: {{ \Carbon\Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}</p> -->
                            <h5 class="mb-1">Tanggal Perjalanan: {{ \Carbon\Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}</h5>
                            <h5 class="mb-3">Tagihan yang belum dibayar: Rp{{ number_format($item->total_harga, 0, ',', '.') }}</h5>
                            <!-- --MODIFIED -->
                            <p>Jumlah Orang: {{ $item->jumlah_orang }} Orang</p>
                            <p>Jenis Perjalanan: {{ ucfirst($item->paket->jenis_paket) }}</p>
                            <!-- --MODIFIED -->
                            <p>Tempat Keberangkatan: {{ ucfirst($item->paket->tempat_keberangkatan) }}</p>
                            <p>Tempat Kepulangan: {{ ucfirst($item->paket->tempat_kepulangan) }}</p>
                            <!-- --MODIFIED -->
                        </div>
                    </div>
                    <!-- MODIFIED-- -->
                    <div class="d-flex bd-highlight justify-content-end align-items-center mt-3">
                        <!-- Notifikasi status apabila terdapat berkas yang belum diverifikasi dan/atau tagihan yang belum lunas -->
                        <!-- MODIFIED-- -->
                        @if($item->is_pembayaran_lunas == 0)
                            <p class="me-auto bd-highlight text-muted">Terdapat tagihan yang belum dilunasi</p>
                            <a href="#" class="bd-highlight btn btn-primary disabled">Berkas Lengkap</a>
                            <a href="/member/tagihan" class="bd-highlight btn btn-primary ms-2"">Lunasi tagihan</a>
                        @else
                            <p class="me-auto bd-highlight text-muted">Terdapat Berkas yang belum diupload</p>
                            <a href="#" class="bd-highlight btn btn-primary">Lengkapi berkas</a>
                            <a href="#" class="bd-highlight btn btn-primary ms-2 disabled"">Tagihan Lunas</a>
                        @endif
                        <!-- --MODIFIED -->
                    </div>
                    <!-- --MODIFIED -->
                </div>
            </div>
        @endforeach
            <!-- MODIFIED-- -->
            <!-- <div class="card col-md-6 mt-3" style="width: 50rem">
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
                    </div> -->
                    <!-- MODIFIED-- -->
                    <!-- <div class="d-flex bd-highlight justify-content-end align-items-center mt-3"> -->
                        <!-- Notifikasi status apabila terdapat berkas yang belum diverifikasi dan/atau tagihan yang belum lunas -->
                        <!-- <p class="me-auto bd-highlight text-muted">Terdapat Tagihan yang belum dilunasi</p> -->

                        <!-- <a href="#" class="bd-highlight btn btn-primary disabled">Berkas terverifikasi</a> -->
                        <!-- MODIFIED-- -->

                        <!-- <a href="#" class="bd-highlight btn btn-primary ms-2"">Tagihan belum lunas</a> -->
                        <!-- <a href="/member/tagihan" class="bd-highlight btn btn-primary ms-2"">Tagihan belum lunas</a> -->

                        <!-- --MODIFIED -->
                    <!-- </div> -->
                    <!-- --MODIFIED -->
                <!-- </div> -->
            <!-- </div> -->
            <!-- --MODIFIED -->
        </div>
    </div>
    @endif

@endsection