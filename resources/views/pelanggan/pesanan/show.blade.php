@extends('adminlte::page')

@section('title', 'Detail Pesanan')

@section('content_header')
    <h1>Pesanan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Detail pesanan</strong>
                </div>
                <div class="card-body">
                     <div>
                        <strong class="d-block">Jenis Kamar</strong>
                        <p>
                            @switch($pesanan->jumlah)
                                @case(1)
                                    Single
                                    @break
                                @case(2)
                                    Couple
                                    @break
                                @default
                                    Quad
                            @endswitch
                        </p>
                    </div>

                    <div>
                        <strong class="d-block">Tanggal Pesan</strong>
                        <p>{{ date('d M Y', strtotime($pesanan->tanggal)) }}</p>
                    </div>

                    <div>
                        <strong class="d-block">Jemaah dalam pesanan ini</strong>
                        <ul>
                            @foreach ($jemaah as $j)
                                <li>{{ $j->nama }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <strong class="d-block">Total Harga</strong>
                        <p>{{ $pesanan->paket->nama }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Paket yang dipesan</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <div>
                                <strong class="d-block">Nama Paket</strong>
                                <p>{{ $pesanan->paket->nama }}</p>
                            </div>

                            <div>
                                <strong class="d-block">Tanggal Keberangkatan</strong>
                                <p>{{ $pesanan->paket->keberangkatan }}</p>
                            </div>

                            <div>
                                <strong class="d-block">Jumlah hari program</strong>
                                <p>{{ $pesanan->paket->jumlah_hari }}</p>
                            </div>

                            <div>
                                <strong class="d-block">Hotel Mekah</strong>
                                <p>{{ $pesanan->paket->hotelMekah->nama }}</p>
                            </div>

                            <div>
                                <strong class="d-block">Hotel Madinah</strong>
                                <p>{{ $pesanan->paket->hotelMadinah->nama }}</p>
                            </div>

                            <div>
                                <strong class="d-block">Maskapai</strong>
                                <p>{{ $pesanan->paket->maskapai->nama }}</p>
                            </div>

                            <div>
                                <p>{{ $pesanan->paket->keterangan }}</p>
                            </div>
                        </div>

                        <div class="col-5">
                            <img src="{{ asset('img/paket/'.$pesanan->paket->image) }}" alt="Banner paket" class="img-fluid">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
