@extends('adminlte::page')

@section('title', 'Pesanan')

@section('content_header')
    <h1>Daftar Paket yang Dipesan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="daftar-pesanan" class="table-bordered">
                       <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tanggal Keberangkatan</th>
                                <th>Jumlah</th>
                                <th></th>
                            </tr>
                       </thead>
                       <tbody>
                           @foreach ($pesanan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->paket->nama }}</td>
                                <td>{{ $p->paket->keberangkatan }}</td>
                                <td>{{ $p->jumlah }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.detail-pesanan', $p->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye mr-2"></i>
                                        Lihat detail
                                    </a>
                                </td>
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
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
@endsection

@section('js')
    <script>
        new DataTable('#daftar-pesanan', {
            responsive: true,
            autoWidht: false
        });
    </script>
@endsection
