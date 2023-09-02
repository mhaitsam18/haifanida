@extends('adminlte::page')

@section('title', 'Testimoni')

@section('content_header')
    <h1>Testimoni</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Testimoni yang telah ditulis
                </div>
                <div class="card-body">
                    <table id="daftar-testimoni" class="table table-bordered">
                       <thead>
                            <tr>
                                <th>No.</th>
                                <th>Paket</th>
                                <th>Tanggal Keberangkatan</th>
                                <th>Testimoni</th>
                                <th>Rating</th>
                            </tr>
                       </thead>
                       <tbody>
                           @foreach ($testimoni as $t)
                            <tr>
                                <td>{{ $loop->iteration.'.' }}</td>
                                <td>{{ $t->paket->nama }}</td>
                                <td>{{ $t->paket->keberangkatan }}</td>
                                @empty ($t->testimoni)
                                    <td>
                                        <a href="{{ route('pelanggan.testimoni.create', $t->id) }}" class="btn btn-primary">
                                            <i class="fa fa-pen mr-2"></i>
                                            Buat testimoni untuk pesanan ini
                                        </a>
                                    </td>
                                    <td>-</td>
                                @else
                                    <td>{{ $t->testimoni }}</td>
                                    <td>
                                        <div>
                                            @php
                                                $rating = $t->rating;
                                            @endphp

                                            @for ($i = 0; $i < $rating; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor

                                                @for ($i = 0; $i < 5-$rating; $i++)
                                                <i class="fas fa-star-o"></i>
                                            @endfor
                                        </div>
                                    </td>
                                @endempty
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
@section('plugins.Sweetalert2', true)

@section('js')
    <script>
        new DataTable('#daftar-testimoni', {
            responsive: true,
            autoWidht: false,
            columnDefs: [{
                orderable: false,
                targets: 4
            }]
        });

        @if (request()->session()->has('alert'))
            Swal.fire({
                icon: '{{ session('alert-class') }}',
                title: '{{ session('alert')[0] }}',
                text: '{{ session('alert')[1] }}',
            });
        @endif
    </script>
@endsection
