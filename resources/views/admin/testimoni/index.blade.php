@extends('adminlte::page')

@section('title', 'Testimoni')

@section('content_header')
    <h1>Daftar Testimoni</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="daftar-testimoni" class="table table-bordered">
                       <thead>
                            <tr>
                                <th>No.</th>
                                <th>Testimoni</th>
                                <th>Rating</th>
                                <th>Paket</th>
                                <th>Pelanggan</th>
                                <th>Aksi</th>
                            </tr>
                       </thead>
                       <tbody>
                           @foreach ($testimoni as $t)
                            <tr>
                                <td>{{ $loop->iteration.'.' }}</td>
                                <td>{{ $t->testimoni }}</td>
                                <td>
                                    @php
                                        $rating = $t->rating;
                                    @endphp

                                    @for ($i = 0; $i < $rating; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor

                                        @for ($i = 0; $i < 5-$rating; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </td>
                                <td>{{ $t->pesanan->paket->nama }}</td>
                                <td>{{ $t->pelanggan->user->name }}</td>
                                <td>
                                    @if ($t->shown == 0)
                                        <a href="{{ route('admin.testimoni.aktif', $t->id) }}" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-check mr-2"></i>
                                            Tampilkan
                                        </a>
                                    @else
                                        <a href="{{ route('admin.testimoni.nonaktif', $t->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times mr-2"></i>
                                            Sembunyikan
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.testimoni.aktif', $t->id) }}" method="POST" id="testimoni-aktif">
        @method('PUT')
        @csrf
    </form>
@stop

@section('plugins.Datatables', true)

@section('js')
    <script>
        new DataTable('#daftar-testimoni', {
            responsive: true,
            autoWidht: false,
            columnDefs: [{
                orderable: false,
                width: "15%",
                targets: 5
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
