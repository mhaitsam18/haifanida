@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Selamat datang di dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-3">
        <x-adminlte-small-box title="{{ $jmlPesanan }}" text="Total Pesanan" icon="fas fa-box" theme="primary"
            url="{{ route('admin.pesanan.index') }}" url-text="Lihat seluruh pesanan" />

    </div>
    <div class="col-3">
        <x-adminlte-small-box title="{{ $jmlTestimoni }}" text="Total Testimoni" icon="fas fa-comment" theme="primary"
            url="{{ route('admin.testimoni.index') }}" url-text="Lihat seluruh testimoni" />
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Pesanan terbaru
            </div>
            <div class="card-body">
                <table id="daftar-pesanan" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Pemesan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesananTerakhir as $p)
                        <tr>
                            <td>{{ $loop->iteration.'.' }}</td>
                            <td>{{ $p->paket->nama }}</td>
                            <td>{{ $p->paket->keberangkatan }}</td>
                            <td>{{ $p->pelanggan->user->name }}</td>
                            <td>{{ $p->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Testimoni terbaru
            </div>
            <div class="card-body">
                <table id="daftar-testimoni" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Testimoni</th>
                            <th>Rating</th>
                            <th>Paket</th>
                            <th>Pelanggan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimoniTerakhir as $t)
                        <tr>
                            <td>{{ $loop->iteration.'.' }}</td>
                            <td>{{ $t->testimoni }}</td>
                            <td>
                                @php
                                $rating = $t->rating;
                                @endphp

                                @for ($i = 0; $i < $rating; $i++) <i class="fa fa-star"></i>
                                    @endfor

                                    @for ($i = 0; $i < 5-$rating; $i++) <i class="fa fa-star-o"></i>
                                        @endfor
                            </td>
                            <td>{{ $t->pesanan->paket->nama }}</td>
                            <td>{{ $t->pelanggan->user->name }}</td>
                            <td>{{ $t->shown ? 'Ditampilkan' : 'Disembunyikan' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
