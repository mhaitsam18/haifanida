@extends('adminlte::page')

@section('title', 'Catatan')

@section('content_header')
    <h1>Daftar Catatan</h1>
@stop

@section('content')
    {{-- <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.catatan.create') }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i>
                Tambah catatan baru
            </a>
        </div>
    </div> --}}

    @foreach ($kategoriCatatan as $k)
        @continue($k[0]->kategori->kategori === 'jadwal_kegiatan')

        @php
            $namaKategori = $k[0]->kategori->nama
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <p class="mb-0 mr-4">
                                Daftar {{ $namaKategori }}
                            </p>

                            <a href="{{ route('admin.catatan.edit', $k[0]->kategori_catatan_id) }}" class="btn btn-secondary btn-sm mr-2">
                                <i class="fa fa-pen mr-2"></i>
                                Edit catatan
                            </a>

                            <form action="{{ route('admin.catatan.destroy', $k[0]->kategori_catatan_id) }}" method="post" id="form-hapus">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" data-c="{{ $k[0]->kategori_catatan_id }}" form="form-hapus">
                                    <i class="fa fa-trash mr-2"></i>
                                    Hapus catatan
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                        <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Catatan</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($k as $catatan)
                                <tr>
                                    <td>{{ $loop->iteration.'.' }}</td>
                                    <td>{{ $catatan->catatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('js')
    <script>
        @if (request()->session()->has('alert'))
            Swal.fire({
                icon: '{{ session('alert-class') }}',
                title: '{{ session('alert')[0] }}',
                text: '{{ session('alert')[1] }}',
            });
        @endif

        // const hapusCatatan = (event) => {
        //     event.preventDefault();

        //     const form = document.getElementById(event.target.getAttribute('form'));
        //     {{-- form.children[2] adalah input hidden pada form yang berisi id testimoni --}}
        //     form.children[2].value = event.target.getAttribute('data-c');

        //     form.submit();
        // }

        // const btnHapus = document.getElementsByClassName('hapus-catatan');
        // for (let i of btnHapus) {
        //     i.addEventListener('click',(event)  => {
        //         hapusCatatan(event);
        //     });
        // }
    </script>
@endsection
