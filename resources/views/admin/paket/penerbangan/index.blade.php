@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            {{-- <h4 class="mb-3 mb-md-0">{{ $title }}</h4> --}}
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">{{ $title }}</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="tambah" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="tambah">
                                <a class="dropdown-item d-flex align-items-center" href="/admin/penerbangan/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a href="/admin/paket/{{ $paket->id }}/penerbangan/create" class="btn btn-sm btn-langit mb-3"><i
                            data-feather="plus" class="icon-sm me-2"></i> Tambah
                        Data
                        Penerbangan</a>
                    <a href="/admin/paket/{{ $paket->id }}" class="btn btn-sm btn-secondary mb-3"><i
                            data-feather="arrow-left" class="icon-sm me-2"></i> Kembali</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama Maskapai</th>
                                    <th class="pt-0">Nomor Penerbangan</th>
                                    <th class="pt-0">PNR</th>
                                    <th class="pt-0">Kelas</th>
                                    <th class="pt-0">Kuota</th>
                                    <th class="pt-0">Keterangan</th>
                                    <th class="pt-0">Harga Tiket</th>
                                    <th class="pt-0">Bandara Asal</th>
                                    <th class="pt-0">Bandara Tujuan</th>
                                    <th class="pt-0">Waktu Keberangkatan</th>
                                    <th class="pt-0">Waktu Kedatangan</th>
                                    <th class="pt-0">Status Penerbangan</th>
                                    <th class="pt-0">Tipe Penerbangan</th>
                                    <th class="pt-0">Gate Penerbangan</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penerbangans as $penerbangan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $penerbangan->maskapai->nama_maskapai }}</td>
                                        <td>{{ $penerbangan->nomor_penerbangan }}</td>
                                        <td>{{ $penerbangan->nomor_pnr }}</td>
                                        <td>{{ $penerbangan->kelas }}</td>
                                        <td>{{ $penerbangan->kuota }}</td>
                                        <td>{{ $penerbangan->keterangan_penerbangan }}</td>
                                        <td>Rp.{{ number_format($penerbangan->total_harga, 2, ',', '.') }}</td>
                                        <td>{{ $penerbangan->bandara_asal }}</td>
                                        <td>{{ $penerbangan->bandara_tujuan }}</td>
                                        <td>{{ Carbon::parse($penerbangan->waktu_keberangkatan)->isoFormat('LL') }}
                                        </td>
                                        <td>{{ Carbon::parse($penerbangan->waktu_kedatangan)->isoFormat('LL') }}
                                        </td>
                                        <td>{{ $penerbangan->status_penerbangan }}</td>
                                        <td>{{ $penerbangan->tipe_penerbangan }}</td>
                                        <td>{{ $penerbangan->gate_penerbangan }}</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                {{-- <a href="/admin/penerbangan/{{ $penerbangan->id }}"
                                                            class="badge bg-haifa d-inline-block ms-1">Detail</a> --}}
                                                <a href="/admin/penerbangan/{{ $penerbangan->id }}/edit"
                                                    class="badge bg-success d-inline-block ms-1">Edit</a>
                                                <form action="/admin/penerbangan/{{ $penerbangan->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="badge bg-danger d-inline-block ms-1 mb-1 badge-a tombol-hapus">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
