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
                                <img src="{{ asset('storage/' . $pemesanan->paket->gambar) }}" class="wd-100 wd-sm-200 me-3"
                                    alt="pemesanan">
                                <div class="mb-2">
                                    <h5 class="mb-2">Detail Pemesanan</h5>
                                    <div class="row">
                                        <div class="col">
                                            <ul>
                                                <li>Nama Paket : {{ $pemesanan->paket->nama_paket }}</li>
                                                <li>
                                                    Tanggal Pemesanan :
                                                    {{ Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}
                                                </li>
                                                <li>Jumlah Pesanan : {{ $pemesanan->jumlah_orang }} pax </li>
                                                <li>Total Harga : {{ number_format($pemesanan->harga, 2, ',', '.') }}</li>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <ul>
                                                <li>
                                                    Tanggal Pelunasan :
                                                    {{ Carbon::parse($pemesanan->tanggal_pelunasan)->isoFormat('LL') }}
                                                </li>
                                                <li>Pembayaran : {{ $pemesanan->metode_pembayaran }}</li>
                                                <li>Status Pelunasan:
                                                    {{ $pemesanan->is_pembayaran_lunas ? 'Lunas' : 'Belum Lunas' }}</li>
                                            </ul>
                                            <a href="/admin/jemaah?pemesanan={{ $pemesanan->id }}"
                                                class="btn btn-sm btn-haifa mb-1"><i data-feather="eye"
                                                    class="icon-sm me-2"></i>Lihat Data Jema'ah</a>
                                            <a href="/admin/pemesanan/{{ $pemesanan->id }}/tagihan"
                                                class="btn btn-sm btn-success mb-1"><i data-feather="file-text"
                                                    class="icon-sm me-2"></i>Lihat Tagihan</a>
                                            <a href="/admin/paket/{{ $pemesanan->paket_id }}/pemesanan"
                                                class="btn btn-sm btn-secondary mb-1"><i data-feather="arrow-left"
                                                    class="icon-sm me-2"></i>Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">Pemesanan Kamar</h4>
                            <a href="/admin/pemesanan/{{ $pemesanan->id }}/pemesanan-kamar/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Pemesanan Kamar</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Tipe Kamar</th>
                                            <th class="pt-0">Jumlah Pengisi</th>
                                            <th class="pt-0">Harga</th>
                                            <th class="pt-0">Keterangan</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pemesanan->pemesananKamars->count() > 0)
                                            @foreach ($pemesanan->pemesananKamars as $kamar)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $kamar->tipe_kamar }}</td>
                                                    <td>{{ $kamar->jumlah_pengisi }}</td>
                                                    <td>Rp.{{ number_format($kamar->harga, 2, ',', '.') }}</td>
                                                    <td>{{ $kamar->keterangan }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/pemesanan-kamar/{{ $kamar->id }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat
                                                                Permintaan</a>
                                                            <a href="/admin/pemesanan-kamar/{{ $kamar->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/pemesanan-kamar/{{ $kamar->id }}"
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
                                                    Pemesanan kamar belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">Pemesanan Ekstra</h4>
                            <a href="/admin/pemesanan/{{ $pemesanan->id }}/pemesanan-ekstra/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Pemesanan Ekstra</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Ekstra / Tambahan</th>
                                            <th class="pt-0">Jumlah</th>
                                            <th class="pt-0">Total Harga</th>
                                            <th class="pt-0">Keterangan</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pemesanan->pemesananEkstras->count() > 0)
                                            @foreach ($pemesanan->pemesananEkstras as $ekstra)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $ekstra->ekstra }}</td>
                                                    <td>{{ $ekstra->jumlah }}</td>
                                                    <td>Rp.{{ number_format($ekstra->total_harga, 2, ',', '.') }}</td>
                                                    <td>{{ $ekstra->keterangan }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/pemesanan-ekstra/{{ $ekstra->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/pemesanan-ekstra/{{ $ekstra->id }}"
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
                                                    Pemesanan Ekstra belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">pembayaran</h4>
                            <a href="/admin/pemesanan/{{ $pemesanan->id }}/pembayaran/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Riwayat
                                pembayaran</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Jumlah Pembayaran</th>
                                            <th class="pt-0">Metode Pembayaran</th>
                                            <th class="pt-0">Tanggal Pembayaran</th>
                                            <th class="pt-0">Bukti Pembayaran</th>
                                            <th class="pt-0">Status Pembayran</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pemesanan->pembayarans->count() > 0)
                                            @foreach ($pemesanan->pembayarans as $pembayaran)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>Rp.{{ number_format($pembayaran->jumlah_pembayaran, 2, ',', '.') }}
                                                    </td>
                                                    <td>{{ $pembayaran->metode_pembayaran }}</td>
                                                    <td>{{ Carbon::parse($pembayaran->tanggal_pembayaran)->isoFormat('LL') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                                            class="btn btn-sm btn-link">Lihat Bukti</a>
                                                    </td>
                                                    <td>{{ $pembayaran->status_pembayaran }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/pembayaran/{{ $pembayaran->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/pembayaran/{{ $pembayaran->id }}"
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
                                                    Riwayat pembayaran belum Tersedia
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
