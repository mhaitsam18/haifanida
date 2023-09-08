@extends('adminlte::page')

@section('title', 'Buat Testimoni')

@section('content_header')
    <h1>Buat Testimoni</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pelanggan.testimoni.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="p" value="{{ $pesanan->id }}">

                        <x-adminlte-textarea name="testimoni" label="Testimoni" error-key="testimoni" enable-old-support="true" rows="4"></x-adminlte-textarea>

                        <x-adminlte-select name="rating" label="Rating" enable-old-support="true">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </x-adminlte-select>

                        <div>
                            <x-adminlte-button label="Kirim" theme="primary" type="submit" icon="fas fa-paper-plane mr-2"></x-adminlte-button>
                            <a href="{{ route('pelanggan.testimoni.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
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
