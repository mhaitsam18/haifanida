@extends('layouts.main')

@section('content')

<div class="section-title text-center">
    <h2>Tagihan</h2>
</div>
<!-- Load semua tagihan yang dimiliki oleh user -->
<div class="container ms-6">
    @foreach ($tagihan as $item)
        <div class="card col-md-6 mb-5 justify-content-center" style="width: 70rem">
            <div class="card-body">
                <h5 class="card-title">Tagihan untuk Perjalanan {{ ucfirst($item->pemesanan->paket->jenis_paket) }} "{{ $item->pemesanan->paket->nama_paket ?? 'Tidak Diketahui'}}"</h5>
                <p>Jumlah: Rp{{ number_format($item->pemesanan->total_harga, 0, ',', '.') }}</p>
                <p>Status: BELUM LUNAS</p>
                <div class="text-end">
                    <a href="" class="btn btn-primary">Bayar</a>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection