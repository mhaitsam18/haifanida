@extends('admin.layouts.main')
@section('style')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/assets-nobleui/vendors/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets-nobleui/vendors/owl.carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets-nobleui/vendors/animate.css/animate.min.css">
    <!-- End plugin css for this page -->
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-start mb-3">
                                <img src="{{ asset('storage/' . $paket->gambar) }}" class="wd-100 wd-sm-200 me-3"
                                    alt="Paket">
                                <div class="mb-2">
                                    <h4 class="mb-2">{{ $paket->nama_paket }}</h4>
                                    <p>{{ $paket->deskripsi }}</p>
                                    <h5 class="mb-2">Detail:</h5>
                                    <div class="row">
                                        <div class="col">
                                            <ul>
                                                <li>Destinasi : {{ $paket->destinasi }}</li>
                                                <li>Jenis Paket : {{ $paket->jenis_paket }}</li>
                                                <li>Durasi : {{ $paket->durasi }} Hari</li>
                                                <li>Harga : Rp.{{ number_format($paket->harga, 2, ',', '.') }}</li>
                                                <li>Kantor : {{ $paket->kantor->nama_kantor }}</li>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <ul>
                                                <li>Tempat Keberangkatan : {{ $paket->tempat_keberangkatan }}</li>
                                                <li>Tempat Kepulangan : {{ $paket->tempat_kepulangan }}</li>
                                                <li>Tanggal Keberangkatan :
                                                    {{ Carbon::parse($paket->tanggal_mulai)->isoFormat('LL') }}
                                                </li>
                                                <li>Tanggal Kepulangan :
                                                    {{ Carbon::parse($paket->tanggal_selesai)->isoFormat('LL') }}</li>
                                            </ul>
                                            {{-- <a href="/admin/paket/{{ $paket->id }}/jemaah"
                                                class="btn btn-sm btn-haifa mb-3"><i data-feather="eye"
                                                    class="icon-sm me-2"></i>Lihat Data Jema'ah</a> --}}
                                            <a href="/admin/paket/{{ $paket->id }}/pemesanan"
                                                class="btn btn-sm btn-haifa mb-3"><i data-feather="eye"
                                                    class="icon-sm me-2"></i>Lihat Pemesanan Paket</a>
                                            <a class="btn btn-sm btn-secondary mb-3" href="/admin/paket">
                                                <span class="">Kembali</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h4 class="mb-2">Fasilitas</h4>
                            {!! $paket->fasilitas !!}
                        </div>
                        <div class="col-md-9">
                            <h4 class="mb-2">Ekstra Paket</h4>
                            <a href="/admin/paket/{{ $paket->id }}/ekstra/create" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Data ekstra paket</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Ekstra</th>
                                            <th class="pt-0">Harga</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($paket->paketEkstras->count() > 0)
                                            @foreach ($paket->paketEkstras as $ekstra)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $ekstra->ekstra->nama_ekstra }}</td>
                                                    <td>{{ $ekstra->harga ?? $ekstra->ekstra->harga_default }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/paket/ekstra/{{ $ekstra->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/paket/ekstra/{{ $ekstra->id }}"
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
                                                    Data ekstra belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">Penginapan</h4>
                            <a href="/admin/paket/{{ $paket->id }}/penginapan/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Data
                                penginapan</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nama Hotel</th>
                                            <th class="pt-0">Nomor Reservasi</th>
                                            <th class="pt-0">Tanggal Check in</th>
                                            <th class="pt-0">Tanggal Check out</th>
                                            <th class="pt-0">Jumlah Kamar</th>
                                            <th class="pt-0">Harga</th>
                                            <th class="pt-0">Keterangan Hotel</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($paket->penginapans->count() > 0)
                                            @foreach ($paket->penginapans as $penginapan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $penginapan->hotel->nama_hotel }}</td>
                                                    <td>{{ $penginapan->nomor_reservasi }}</td>
                                                    <td>{{ $penginapan->tanggal_check_in }}</td>
                                                    <td>{{ $penginapan->tanggal_check_out }}</td>
                                                    <td>{{ $penginapan->jumlah_kamar }}</td>
                                                    <td>{{ $penginapan->total_harga }}</td>
                                                    <td>{{ $penginapan->keterangan_hotel }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/penginapan/{{ $penginapan->id }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat Kamar</a>
                                                            <a href="/admin/penginapan/{{ $penginapan->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/penginapan/{{ $penginapan->id }}"
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
                                                    Data penginapan belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">Penerbangan</h4>
                            <a href="/admin/paket/{{ $paket->id }}/penerbangan/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Data
                                Penerbangan</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
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
                                            <th class="pt-0">Waktu Penerbangan</th>
                                            <th class="pt-0">Tipe Penerbangan</th>
                                            <th class="pt-0">Gate Penerbangan</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($paket->penerbangans->count() > 0)
                                            @foreach ($paket->penerbangans as $penerbangan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $penerbangan->maskapai->nama_maskapai }}</td>
                                                    <td>{{ $penerbangan->nomor_penerbangan }}</td>
                                                    <td>{{ $penerbangan->nomor_pnr }}</td>
                                                    <td>{{ $penerbangan->kelas }}</td>
                                                    <td>{{ $penerbangan->kuota }}</td>
                                                    <td>{{ $penerbangan->keterangan_penerbangan }}</td>
                                                    <td>{{ $penerbangan->total_harga }}</td>
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
                                                            <form action="/admin/penerbangan/{{ $penerbangan->id }}"
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
                                                <td colspan="17">
                                                    Data Penerbangan belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-2 mt-2">Data Grup</h4>
                            <a href="/admin/paket/{{ $paket->id }}/grup/create" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="plus" class="icon-sm me-2"></i> Tambah Data
                                Grup</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nama Agen</th>
                                            <th class="pt-0">Nama Grup</th>
                                            <th class="pt-0">Keterangan</th>
                                            <th class="pt-0">Kuota</th>
                                            <th class="pt-0">Status</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($paket->grups->count() > 0)
                                            @foreach ($paket->grups as $grup)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $grup->agen->user->name ?? null }}</td>
                                                    <td>{{ $grup->nama_grup }}</td>
                                                    <td>{{ $grup->keterangan_grup }}</td>
                                                    <td>{{ $grup->kuota_grup }}</td>
                                                    <td>{{ $grup->status_grup }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/grup/{{ $grup->id }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat
                                                                Jema'ah</a>
                                                            <a href="/admin/grup/{{ $grup->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/grup/{{ $grup->id }}"
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
                                                <td colspan="7">
                                                    Data Grup belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-2 mt-2">Data Bus</h4>
                            <a href="/admin/paket/{{ $paket->id }}/bus/create" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="plus" class="icon-sm me-2"></i> Tambah Data
                                Bus</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nomor Rombongan</th>
                                            <th class="pt-0">Nomor Polisi</th>
                                            <th class="pt-0">Merek</th>
                                            <th class="pt-0">Kapsitas</th>
                                            <th class="pt-0">Fasilitas</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($paket->buses->count() > 0)
                                            @foreach ($paket->buses as $bus)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $bus->nomor_rombongan }}</td>
                                                    <td>{{ $bus->nomor_polisi }}</td>
                                                    <td>{{ $bus->merek }}</td>
                                                    <td>{{ $bus->kapasitas }}</td>
                                                    <td>{{ $bus->fasilitas }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/bus/{{ $bus->id }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat Data
                                                                Penumpang</a>
                                                            <a href="/admin/bus/{{ $bus->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/bus/{{ $bus->id }}" method="post">
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
                                                <td colspan="7">
                                                    Data bus belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2 mt-2">Galeri</h4>
                            <a href="/admin/paket/{{ $paket->id }}/galeri/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i>
                                Tambah Foto</a>
                            {{-- <a href="/admin/paket/{{ $paket->id }}/galeri" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="eye" class="icon-sm me-2"></i> Lihat Semua Foto</a> --}}
                            <div class="owl-carousel owl-theme owl-mouse-wheel">
                                @if ($paket->galeris->count() > 0)
                                    @foreach ($paket->galeris as $galeri)
                                        <div class="item" data-bs-toggle="popover" title="{{ $galeri->nama }}"
                                            data-bs-content="{{ $galeri->deskripsi }}" data-bs-placement="bottom">
                                            <img src="{{ asset('storage/' . $galeri->file_path) }}" alt="item-image">
                                        </div>
                                    @endforeach
                                @else
                                    Tidak Ada Foto
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
@section('script')
    <!-- Plugin js for this page -->
    <script src="/assets-nobleui/vendors/owl.carousel/owl.carousel.min.js"></script>
    <script src="/assets-nobleui/vendors/jquery-mousewheel/jquery.mousewheel.js"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="/assets-nobleui/js/carousel.js"></script>
    <!-- End custom js for this page -->
@endsection
