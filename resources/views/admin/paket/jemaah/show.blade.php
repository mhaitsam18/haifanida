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
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="lihat" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="lihat">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/admin/jemaah/{{ $jemaah->id }}/berkas"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">Lihat Berkas</span></a>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/admin/jemaah/{{ $jemaah->id }}/kamar"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">Lihat Kamar</span></a>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/admin/jemaah/{{ $jemaah->id }}/bus"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">Lihat Bus</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-start mb-3">
                                <img src="{{ asset('storage/' . $jemaah->foto) }}" class="wd-100 wd-sm-200 me-3"
                                    alt="jemaah">
                                <div class="mb-2">
                                    <h5 class="mb-2">Detail jemaah</h5>
                                    <div class="row">
                                        <div class="col">
                                            <ul>
                                                <li>Nomor KTP : {{ $jemaah->nomor_ktp }}</li>
                                                <li>Nama Lengkap : {{ $jemaah->nama_lengkap }}</li>
                                                {{-- <li>Nama Lengkap : {{ $jemaah->nama_paket }}</li> --}}
                                                <li>Nomor Sesuai Paspor : {{ $jemaah->nama_sesuai_paspor }}</li>
                                                <li>Tempat, Tanggal Lahir : {{ $jemaah->tempat_lahir }},
                                                    {{ Carbon::parse($jemaah->tanggal_lahir)->isoFormat('LL') }}</li>
                                                <li>Jenis Kelamin : {{ $jemaah->jenis_kelamin }}</li>
                                                <li>Kewarganegaraan : {{ $jemaah->kewarganegaraan }}</li>
                                                <li>Alamat Lengkap: {{ $jemaah->alamat }}</li>
                                                <li>Kelurahan: {{ $jemaah->kelurahan }}</li>
                                                <li>Kecamatan: {{ $jemaah->kecamatan }}</li>
                                                <li>Kabupaten: {{ $jemaah->kabupaten }}</li>
                                                <li>Provinsi: {{ $jemaah->provinsi }}</li>
                                                <li>Kode Pos: {{ $jemaah->kode_pos }}</li>

                                            </ul>
                                        </div>
                                        <div class="col">
                                            <ul>
                                                <li>Nomor Ponsel: {{ $jemaah->nomor_telepon }}</li>
                                                <li>Email: {{ $jemaah->email }}</li>
                                                <li>Tingkat Pendidikan: {{ $jemaah->tingkat_pendidikan }}</li>
                                                <li>Pekerjaan: {{ $jemaah->pekerjaan }}</li>
                                                <li>Nomor Paspor: {{ $jemaah->nomor_paspor }}</li>
                                                <li>Tempat dikeluarkan: {{ $jemaah->tempat_dikeluarkan }}</li>
                                                <li>Tanggal dikeluarkan: {{ $jemaah->tanggal_dikeluarkan }}</li>
                                                <li>Tanggal Kadaluarsa: {{ $jemaah->tanggal_kadaluarsa }}</li>
                                                <li>Pernah Umroh: {{ $jemaah->pernah_umroh ? 'Pernah' : 'Belum' }}</li>
                                                <li>Pernah Haji: {{ $jemaah->pernah_haji ? 'Pernah' : 'Belum' }}</li>
                                                <li>Golongan Darah: {{ $jemaah->golongan_darah }}</li>
                                                <li>Nama Keluarga Terdekat: {{ $jemaah->nama_keluarga_terdekat }}</li>
                                                <li>Kontak Keluarga Terdekat: {{ $jemaah->kontak_keluarga_terdekat }}</li>
                                                <li>Status: {{ $jemaah->is_active ? 'Aktif' : 'Tidak Aktif' }}</li>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            @if ($jemaah->jenis_kelamin == 'Perempuan' && $jemaah->mahram)
                                                @if ($jemaah->mahram ?? null)
                                                    <ul>
                                                        <li>Nama Mahram: {{ $jemaah->mahram->nama_lengkap }}</li>
                                                        <li>Hubungan dengan Mahram: {{ $jemaah->hubungan_mahram }}
                                                        </li>
                                                    </ul>
                                                @endif
                                            @elseif ($jemaah->jenis_kelamin == 'Laki-laki')
                                                <h4 class="mb-2">Data Mahram / Pasangan</h4>
                                                <table class="table table-hover mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="pt-0">#</th>
                                                            <th class="pt-0">Nama Mahram</th>
                                                            <th class="pt-0">Hubungan dengan Mahram</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($jemaah->mahrams as $mahram)
                                                            @php
                                                                $hubungan = '';
                                                                switch ($mahram->hubungan_mahram) {
                                                                    case 'Ayah':
                                                                        $hubungan = 'Anak';
                                                                        break;
                                                                    case 'Anak':
                                                                        $hubungan = 'Ibu';
                                                                        break;
                                                                    case 'Suami':
                                                                        $hubungan = 'Istri';
                                                                        break;
                                                                    case 'Saudara Kandung':
                                                                        $hubungan = 'Saudari Kandung';
                                                                        break;
                                                                    case 'Kakek':
                                                                        $hubungan = 'Cucu';
                                                                        break;
                                                                    case 'Cucu':
                                                                        $hubungan = 'Nenek';
                                                                        break;
                                                                    case 'Paman':
                                                                        $hubungan = 'Keponakan';
                                                                        break;
                                                                    case 'Keponakan':
                                                                        $hubungan = 'Bibi';
                                                                        break;
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $mahram->nama_lengkap }}</td>
                                                                <td>{{ $hubungan }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="9">
                                                                    mahram Jema'ah belum Tersedia
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            @endif
                                            <a href="/admin/pemesanan/{{ $jemaah->pemesanan_id }}"
                                                class="btn btn-sm btn-haifa mb-1"><i data-feather="eye"
                                                    class="icon-sm me-2"></i>Lihat Detail Pemesanan</a>
                                            <a href="/admin/grup/{{ $jemaah->grup_id }}"
                                                class="btn btn-sm btn-success mb-1"><i data-feather="file-text"
                                                    class="icon-sm me-2"></i>Lihat Grup</a>
                                            <a href="/admin/paket/{{ $paket->id }}/jemaah"
                                                class="btn btn-sm btn-secondary mb-1"><i data-feather="arrow-left"
                                                    class="icon-sm me-2"></i>Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4 class="mb-2">Testimoni</h4>
                            <textarea class="form-control" readonly>{{ $jemaah->testimoni->isi_testimoni ?? 'Testimoni Tidak Tersedia' }}</textarea>
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-2">Sertifikat</h4>
                            <a href="/admin/jemaah/{{ $jemaah->id }}/sertifikat/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Sertifikat</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-3">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nomor Sertifikat</th>
                                            <th class="pt-0">Tanggal Penerbitan</th>
                                            <th class="pt-0">Tanggal Kadaluarsa</th>
                                            <th class="pt-0">Jenis Sertifikat</th>
                                            <th class="pt-0">Sertifikat</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($jemaah->sertifikatJemaahs->count() > 0)
                                            @foreach ($jemaah->sertifikatJemaahs as $sertifikat)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $sertifikat->nomor_sertifikat }}</td>
                                                    <td>{{ Carbon::parse($sertifikat->tanggal_penerbitan)->isoFormat('LL') }}
                                                    </td>
                                                    <td>{{ Carbon::parse($sertifikat->tanggal_kadaluarsa)->isoFormat('LL') }}
                                                    </td>
                                                    <td>{{ $sertifikat->jenis_sertifikat }}</td>
                                                    <td><img src="{{ asset('storage/' . $sertifikat->sertifikat) }}"
                                                            alt=""
                                                            style="border-radius: 0%; width: 120px; height: 80px;"></td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/sertifikat-jemaah/{{ $sertifikat->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/sertifikat-jemaah/{{ $sertifikat->id }}"
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
                                                    sertifikat Jema'ah belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-2">Berkas Jema'ah</h4>
                            <a href="/admin/jemaah/{{ $jemaah->id }}/berkas/create" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="plus" class="icon-sm me-2"></i>
                                Tambah
                                Berkas Jema'ah</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-3">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nama berkas</th>
                                            <th class="pt-0">Status</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($jemaah->berkasJemaahs->count() > 0)
                                            @foreach ($jemaah->berkasJemaahs as $berkas)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $berkas->berkas->nama_berkas }}</td>
                                                    <td>{{ $berkas->status }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="{{ route('admin.jemaah.berkas.preview', [$jemaah->id, $berkas->id]) }}" target="_blank" class="badge bg-haifa d-inline-block ms-1">Lihat Berkas di storage</a>
                                                            <a href="{{ asset('storage/' . $berkas->file_path) }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat Berkas</a>
                                                            {{-- <a href="/admin/berkas-jemaah/{{ $berkas->id }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat Berkas</a> --}}
                                                            <a href="/admin/berkas-jemaah/{{ $berkas->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/berkas-jemaah/{{ $berkas->id }}"
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
                                                    Berkas Jema'ah belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-2">Bus Jema'ah</h4>
                            <a href="/admin/jemaah/{{ $jemaah->id }}/bus/create" class="btn btn-sm btn-langit mb-3"><i
                                    data-feather="plus" class="icon-sm me-2"></i> Tambah
                                Bus Jema'ah</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-3">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nomor Kursi</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($jemaah->busJemaahs->count() > 0)
                                            @foreach ($jemaah->busJemaahs as $bus)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $bus->nomor_kursi }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/bus-jemaah/{{ $bus->id }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat Data
                                                                Penumpang</a>
                                                            <a href="/admin/bus-jemaah/{{ $bus->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/bus-jemaah/{{ $bus->id }}"
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
                                                    Bus Jema'ah belum Tersedia
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-2">Kamar Jema'ah</h4>
                            <a href="/admin/jemaah/{{ $jemaah->id }}/kamar/create"
                                class="btn btn-sm btn-langit mb-3"><i data-feather="plus" class="icon-sm me-2"></i>
                                Tambah
                                Kamar Jema'ah</a>
                            <div class="table-responsive">
                                {{-- id="dataTableExample" --}}
                                <table class="table table-hover mb-3">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Nomor Kamar</th>
                                            <th class="pt-0">Tipe Kamar</th>
                                            <th class="pt-0">Kapasitas</th>
                                            <th class="pt-0">Kota</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($jemaah->KamarJemaahs->count() > 0)
                                            @foreach ($jemaah->KamarJemaahs as $kamar)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $kamar->kamar->nomor_kamar }}</td>
                                                    <td>{{ $kamar->kamar->tipe_kamar }}</td>
                                                    <td>{{ $kamar->kamar->kapasitas }}</td>
                                                    <td>{{ $kamar->kamar->paketHotel->hotel->kota }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <a href="/admin/kamar/{{ $kamar->kamar_id }}"
                                                                class="badge bg-haifa d-inline-block ms-1">Lihat Anggota
                                                                Kamar</a>
                                                            <a href="/admin/kamar-jemaah/{{ $kamar->id }}/edit"
                                                                class="badge bg-success d-inline-block ms-1">Edit</a>
                                                            <form action="/admin/kamar-jemaah/{{ $kamar->id }}"
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
                                                    Kamar Jema'ah belum Tersedia
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
