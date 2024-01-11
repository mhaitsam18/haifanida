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
                        <h6 class="card-title mb-2">{{ $title }}</h6>
                    </div>
                    <a href="/admin/grup/{{ $grup->id }}/isu-perjalanan/create" class="btn btn-sm btn-langit mb-3"><i
                            data-feather="plus" class="icon-sm me-2"></i> Tambah Isu</a>
                    <a href="/admin/grup/{{ $grup->paket_id }}" class="btn btn-sm btn-secondary mb-3"><i
                            data-feather="arrow-left" class="icon-sm me-2"></i> Kembali</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Masalah</th>
                                    <th class="pt-0">Solusi</th>
                                    <th class="pt-0">Waktu Pelaporan</th>
                                    <th class="pt-0">Waktu Penyelesaian</th>
                                    <th class="pt-0">Status</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($isuPerjalanans as $isu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $isu->masalah }}</td>
                                        <td>{{ $isu->solusi }}</td>
                                        <td>{{ Carbon::parse($isu->waktu_pelaporan)->isoFormat('LLL') }}</td>
                                        <td>{{ Carbon::parse($isu->waktu_penyelesaian)->isoFormat('LLL') }}
                                        </td>
                                        <td>{{ $isu->status ? 'Dalam Penanganan' : 'Sudah Selesai' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <a href="/admin/isu-perjalanan/{{ $isu->id }}/edit"
                                                    class="badge bg-success d-inline-block ms-1">Edit</a>
                                                <form action="/admin/isu-perjalanan/{{ $isu->id }}" method="post">
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
