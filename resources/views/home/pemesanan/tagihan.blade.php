@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/tagihan.css') }}">
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            {{-- <h4 class="mb-3 mb-md-0">{{ $title }}</h4> --}}
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body border rounded p-2">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-md-3 ps-0">
                                <a href="#" class="noble-ui-logo d-block mt-3">
                                    <img src="/assets/img/logos/logo.png" alt="" class="img-fluid"
                                        style="height: 100px">
                                </a>
                                <p class="mt-1 mb-1"><b>PT. Haifa Nida Wisata Karawang</b></p>
                                <p>Jl. RA. Kartini, No.1,<br>Kel. Karangpawitan, Kec. Karawang Barat. <br>Kab. Karawang, Jawa
                                    Barat - 41315</p>
                                <h5 class="mt-5 mb-2 text-muted">Tagihan Untuk :</h5>
                                <p>
                                    Sdr/i, {{ $pemesanan->user->name }}
                                    <br>
                                    {{ $pemesanan->user->member->alamat ?? null }}
                                </p>
                            </div>
                            <div class="col-md-4 pe-0 text-end">
                                <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">Faktur</h4>
                                <h6 class="text-end mb-5 pb-4"># INV-{{ $pemesanan->id }}</h6>
                                <p class="text-end mb-1"><b>Total Tagihan</b></p>
                                <h4 class="text-end fw-normal">Rp.{{ number_format($balance, 2, ',', '.') }}</h4>
                                <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Tanggal Faktur :</span>
                                    {{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</h6>
                                <h6 class="text-end fw-normal"><span class="text-muted">Tenggat Waktu Deposit :</span>
                                    {{ Carbon::parse($pemesanan->tanggal_pesan)->addDays(1)->isoFormat('LL') }} 16:00 WIB</h6>
                                <h6 class="text-end fw-normal"><span class="text-muted">Tenggat Waktu Pelunasan :</span>
                                    {{ Carbon::parse($pemesanan->paket->tanggal_mulai)->subDays(30)->isoFormat('LL') }} 16:00 WIB</h6>
                            </div>
                        </div>


                    </div>
                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Deskripsi</th>
                                        <th class="text-end">Jumlah</th>
                                        <th class="text-end">Biaya satuan</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($tagihans as $tagihan)
                                        <tr class="text-end">
                                            <td class="text-start">{{ $loop->iteration }}</td>
                                            <td class="text-start">{{ $tagihan['deskripsi'] }}</td>
                                            <td>{{ $tagihan['jumlah'] . ' ' . $tagihan['satuan'] }}</td>
                                            <td>Rp.{{ number_format($tagihan['biaya_satuan'], 2, ',', '.') }}</td>
                                            <td>Rp.{{ number_format($tagihan['total'], 2, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $total += $tagihan['total'];
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid mt-3 w-100">
                        <div class="row">
                            <div class="col-md-6 order-2 order-md-1 mt-4 mt-md-0">
                                <h3>Informasi No. Rekening</h3>
                                <h6>Bank Mandiri</h6>
                                <span class="">1320014831409 a/n Haifa Nida Wisata Karawang</span>
                                <h6>Bank BCA</h6>
                                <span class="">1092826656 a/n Haifa Nida Wisata Karawang</span>
                                <h6>Bank BJB</h6>
                                <span class="">0000410697000 a/n Haifa nida wisata karawang, PT</span>
                                <h6>Bank CIMB Niaga</h6>
                                <span class="">860018161900 a/n Haifa Nida Wisata Karawang</span>
                            </div>
                            <div class="col-md-6 ms-auto order-1 order-md-2 mt-4 mt-md-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="text-end">Rp.{{ number_format($total, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td><s>TAX (11%)</s></td>
                                                @php
                                                    $tax = ($total * 11) / 100;
                                                @endphp
                                                <td class="text-end">
                                                    <s>Rp.{{ number_format($tax, 2, ',', '.') }}</s>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-800">Total</td>
                                                @php
                                                    // $total += $tax;
                                                @endphp
                                                <td class="text-bold-800 text-end">
                                                    Rp.{{ number_format($total, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>pembayaran dilakukan</td>
                                                <td class="text-danger text-end">(-)
                                                    Rp.{{ number_format($pembayaran, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-bold-800">Balance / Sisa Tagihan yang harus dibayarkan</td>
                                                @php
                                                    $total -= $pembayaran;
                                                @endphp
                                                <td class="text-bold-800 text-end">
                                                    Rp.{{ number_format($total, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid w-100">
                        {{-- <a href="javascript:;" class="btn btn-haifa float-end mt-4 ms-2"><i data-feather="send"
                                class="me-3 icon-md"></i>Kirim Tagihan</a>
                        <a href="javascript:;" class="btn btn-outline-haifa float-end mt-4 ms-2"><i data-feather="printer"
                                class="me-2 icon-md"></i>Cetak</a> --}}
                        <a href="{{ route('pemesanan.detail', $pemesanan->id) }}" class="btn btn-secondary float-end mt-4 ms-2"><i
                                data-feather="arrow-left" class="icon-sm me-2"></i>Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
