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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-start mb-3">
                                <img src="{{ asset('storage/' . $grup->paket->gambar) }}" class="wd-100 wd-sm-200 me-3"
                                    alt="grup">
                                <div class="mb-2">
                                    <h5 class="mb-2">Detail Grup</h5>
                                    <div class="row">
                                        <div class="col">
                                            <ul>
                                                <li>Nama Paket : {{ $grup->paket->nama_paket }}</li>
                                                <li>Nama Grup : {{ $grup->nama_grup }}</li>
                                                <li>Nama Agen : {{ $grup->agen->user->name ?? '' }}</li>
                                                <li>Ketua Grup : {{ $grup->ketua_grup }}</li>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <ul>
                                                <li>Kuota Grup : {{ $grup->kuota_grup }}</li>
                                                <li>Status Grup : {{ $grup->status_grup }}</li>
                                                <li>Keterangan Grup : {{ $grup->keterangan_grup }}</li>
                                            </ul>
                                            <a href="/admin/jemaah?grup={{ $grup->id }}"
                                                class="btn btn-sm btn-haifa mb-1"><i data-feather="eye"
                                                    class="icon-sm me-2"></i>Lihat Data Jema'ah</a>
                                            <a href="/admin/grup/{{ $grup->id }}/tagihan"
                                                class="btn btn-sm btn-success mb-1"><i data-feather="file-text"
                                                    class="icon-sm me-2"></i>Lihat Tagihan Grup</a>
                                            <a href="/admin/paket/{{ $grup->paket_id }}/grup"
                                                class="btn btn-sm btn-secondary mb-1"><i data-feather="arrow-left"
                                                    class="icon-sm me-2"></i>Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">Isu Perjalanan</h4>
                            <a href="/admin/grup/{{ $grup->id }}/isu-perjalanan/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i> Buat
                                Isu</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
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
                                        @if ($grup->IsuPerjalanans->count() > 0)
                                            @foreach ($grup->IsuPerjalanans as $isu)
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
                                                            <form action="/admin/isu-perjalanan/{{ $isu->id }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="badge bg-danger d-inline-block ms-1 mb-1 badge-a tombol-hapus">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9">
                                                    Isu Perjalanan belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">Jadwal</h4>
                            <a href="/admin/grup/{{ $grup->id }}/jadwal/create" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Jadwal</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nama Agenda</th>
                                            <th class="pt-0">Lokasi</th>
                                            <th class="pt-0">Waktu Mulai</th>
                                            <th class="pt-0">Waktu Selesai</th>
                                            <th class="pt-0">Keterangan</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($grup->jadwals->count() > 0)
                                            @foreach ($grup->jadwals as $jadwal)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $jadwal->nama_agenda }}</td>
                                                    <td>{{ $jadwal->lokasi }}</td>
                                                    <td>{{ Carbon::parse($jadwal->waktu_mulai)->isoFormat('LLL') }}</td>
                                                    <td>{{ Carbon::parse($jadwal->waktu_selesai)->isoFormat('LLL') }}</td>
                                                    <td>{{ $jadwal->keterangan }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/jadwal/{{ $jadwal->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/jadwal/{{ $jadwal->id }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="badge bg-danger d-inline-block ms-1 mb-1 badge-a tombol-hapus">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9">
                                                    Jadwal belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection