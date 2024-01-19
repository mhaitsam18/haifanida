@extends('admin.layouts.main')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="lihat" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="lihat">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/admin/paket/{{ $grup->paket_id }}/jemaah?grup_id={{ $grup->id }}"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">Lihat
                                        Jema'ah</span></a>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/admin/grup/{{ $grup->id }}/isu-perjalanan"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">Lihat Isu Perjalanan</span></a>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/admin/grup/{{ $grup->id }}/jadwal"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">Lihat Jadwal</span></a>
                            </div>
                        </div>
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
                                            <a href="/admin/paket/{{ $grup->paket_id }}/jemaah?grup_id={{ $grup->id }}"
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
                        <div class="col-md-12 mt-4">
                            <h4>Masukkan Jema'ah</h4>
                        </div>
                        <div class="col-md-5 mt-4">
                            <h6 class="mb-2">Data Jema'ah</h6>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nama Lengkap</th>
                                            <th class="pt-0">Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($jemaahs->count() > 0)
                                            @foreach ($jemaahs as $jemaah)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $jemaah->nama_lengkap }}</td>
                                                    <td>
                                                        <input type="checkbox" value="{{ $jemaah->id }}"
                                                            name="jemaah_ids[]">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9">
                                                    jemaah Tidak Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-1 mt-4 text-center">
                            <div class="mt-5 row">
                                <div class="mb-3">
                                    <button type="button" id="pindah-ke-grup" class="btn btn-sm btn-info">
                                        <i data-feather="arrow-right" class="icon-sm"></i>
                                    </button>
                                </div>
                                <div class="mb-3">
                                    <button type="button" id="kembali-ke-jemaah" class="btn btn-sm btn-info">
                                        <i data-feather="arrow-left" class="icon-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <h6 class="mb-2">Data Anggota Grup</h6>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nama Lengkap</th>
                                            <th class="pt-0">Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($anggotas->count() > 0)
                                            @foreach ($anggotas as $anggota)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $anggota->nama_lengkap }}</td>
                                                    <td>
                                                        <input type="checkbox" value="{{ $anggota->id }}"
                                                            name="anggota_ids[]">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9">
                                                    Anggota Tidak Tersedia
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
@section('script')
    <script>
        $(document).ready(function() {
            // Jika tombol panah ke kanan diklik
            $('#pindah-ke-grup').click(function() {
                var selectedJemaahs = $('input[name="jemaah_ids[]"]:checked').map(function() {
                    return this.value;
                }).get();
                var token = $('meta[name="csrf-token"]').attr('content');

                // Kirim data ke server
                $.post('/admin/grup/pindah-ke-grup', {
                    jemaah_ids: selectedJemaahs,
                    _token: token,
                    grup_id: {{ $grup->id }}
                }, function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
            });

            // Jika tombol panah ke kiri diklik
            $('#kembali-ke-jemaah').click(function() {
                var selectedAnggotas = $('input[name="anggota_ids[]"]:checked').map(function() {
                    return this.value;
                }).get();
                var token = $('meta[name="csrf-token"]').attr('content');

                // Kirim data ke server
                $.post('/admin/grup/kembali-ke-jemaah', {
                    anggota_ids: selectedAnggotas,
                    _token: token
                }, function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
            });
        });
    </script>
@endsection
