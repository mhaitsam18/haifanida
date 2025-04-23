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
                                <a class="dropdown-item d-flex align-items-center" href="/admin/paket/create"><i
                                        data-feather="plus" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-haifa my-2" href="/admin/paket/create"><i data-feather="plus"
                            class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    {{-- <th class="pt-0">Kode Paket</th> --}}
                                    <th class="pt-0">Nama Paket</th>
                                    <th class="pt-0">Jenis Paket</th>
                                    <th class="pt-0">Destinasi</th>
                                    <th class="pt-0">Durasi</th>
                                    <th class="pt-0">Harga</th>
                                    <th class="pt-0">Fasilitas</th>
                                    <th class="pt-0">Deskripsi</th>
                                    <th class="pt-0">Tempat Keberangkatan</th>
                                    <th class="pt-0">Tempat Kepulangan</th>
                                    <th class="pt-0">Tanggal Mulai</th>
                                    <th class="pt-0">Tanggal Selesai</th>
                                    <th class="pt-0">Gambar</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pakets as $paket)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $paket->kode_paket }}</td> --}}
                                        <td>{{ $paket->nama_paket }}</td>
                                        <td>{{ $paket->jenis_paket }}</td>
                                        <td>{{ $paket->destinasi }}</td>
                                        <td>{{ $paket->durasi }} Hari</td>
                                        <td>Rp.{{ number_format($paket->harga, 2, ',', '.') }}</td>
                                        <td>{!! $paket->fasilitas !!}</td>
                                        <td>{{ $paket->deskripsi }}</td>
                                        <td>{{ $paket->tempat_keberangkatan }}</td>
                                        <td>{{ $paket->tempat_kepulangan }}</td>
                                        <td>{{ Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}</td>
                                        <td>{{ Carbon::parse($paket->tanggal_selesai)->isoFormat('LL') }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $paket->gambar) }}" alt="Foto Kantor"
                                                style="border-radius: 0%; width: 150px; height: 100px;">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <a href="/admin/paket/{{ $paket->id }}"
                                                    class="badge bg-haifa d-inline-block ms-1">Detail</a>
                                                <a href="/admin/paket/{{ $paket->id }}/edit"
                                                    class="badge bg-success d-inline-block ms-1">Edit</a>
                                                <form action="/admin/paket/{{ $paket->id }}" method="post">
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
