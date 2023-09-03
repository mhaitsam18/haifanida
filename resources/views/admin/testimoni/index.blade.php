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
                                        <x-adminlte-button
                                            label="Tampilkan"
                                            theme="secondary"
                                            type="submit"
                                            class="btn-sm update-testimoni"
                                            icon="fas fa-paper-plane mr-2"
                                            form="testimoni-aktif"
                                            data-t="{{ $t->id }}">
                                        </x-adminlte-button>
                                    @else
                                        <x-adminlte-button
                                            label="Sembunyikan"
                                            theme="danger"
                                            type="submit"
                                            class="btn-sm update-testimoni"
                                            icon="fas fa-paper-plane mr-2"
                                            form="testimoni-nonaktif"
                                            data-t="{{ $t->id }}">
                                        </x-adminlte-button>
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

    <form action="{{ route('admin.testimoni.aktif') }}" method="POST" id="testimoni-aktif">
        @method('PUT')
        @csrf
        <input type="hidden" name="t" id="ta">
    </form>

    <form action="{{ route('admin.testimoni.nonaktif') }}" method="POST" id="testimoni-nonaktif">
        @method('PUT')
        @csrf
        <input type="hidden" name="t" id="tn">
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

        const updateTestimoni = (event) => {
            event.preventDefault();

            const form = document.getElementById(event.target.getAttribute('form'));
            {{-- form.children[2] adalah input hidden pada form yang berisi id testimoni --}}
            form.children[2].value = event.target.getAttribute('data-t');

            form.submit();
        }

        const btnUpdate = document.getElementsByClassName('update-testimoni');
        for (let i of btnUpdate) {
            i.addEventListener('click',(event)  => {
                updateTestimoni(event);
            });
        }
    </script>
@endsection
