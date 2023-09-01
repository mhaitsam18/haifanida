@extends('adminlte::page')

@section('title', 'Kontak Admin')

@section('content_header')
    <h1>Kontak Admin</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Daftar kontak admin yang bisa dihubungi
                </div>
                <div class="card-body">
                    <table id="daftar-kontak" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontak as $k)
                                <tr>
                                    <td>{{ $k->key }}</td>
                                    <td>{{ $k->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@section('js')
    <script>
        new DataTable('#daftar-kontak', {
            responsive: true,
            autoWidht: false,
            paging: false,
        });
    </script>
@stop
