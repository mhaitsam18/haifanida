@extends('layouts.main')

@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/daftar-keberangkatan.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/daftar-keberangkatan-mobile.css') }}">
@endsection

@section('content')


    <div class="section-title text-center">
        <h2>Daftar Keberangkatan</h2>
        <h6>Daftar perjalanan yang akan datang</h6>
    </div>

    @php
        use Carbon\Carbon;
        use App\Models\Berkas;
        $requiredBerkas = Berkas::all();
    @endphp

    @if($pemesanan && count($pemesanan) > 0)
    <div class="container">
        <!-- Status Info -->
        <div class="alert alert-info mt-4 shadow-sm">
            <div class="d-flex align-items-start">
                <i class="fas fa-info-circle me-2 mt-1 fa-lg"></i>
                <div>
                    <h6 class="alert-heading mb-2 fw-semibold">Informasi Status Pemesanan</h6>
                    <ul class="mb-0 small">
                        <li><strong>Tertunda:</strong> Pesanan Anda sedang menunggu konfirmasi dari admin.</li>
                        <li><strong>Diterima/Dikonfirmasi:</strong> Pesanan Anda telah disetujui. Anda dapat melanjutkan untuk melengkapi data jemaah.</li>
                        <li><strong>Ditolak/Dibatalkan:</strong> Pesanan Anda ditolak atau dibatalkan. Silakan hubungi admin untuk informasi lebih lanjut.</li>
                    </ul>
                </div>
            </div>
        </div>
        @foreach($pemesanan as $item)
            @php
                $departure = Carbon::parse($item->paket->tanggal_mulai);
                $returnDate = Carbon::parse($item->paket->tanggal_selesai);
                $sisa_hari = Carbon::now()->diffInDays($departure, false);
                $isTripExpired = Carbon::now()->greaterThan($returnDate->copy()->addDay());
                $hasIncompleteDocuments = $item->jemaahs->some(function($jemaah) use ($requiredBerkas) {
                    $uploadedBerkasIds = $jemaah->berkasJemaahs->pluck('berkas_id')->toArray();
                    $requiredBerkasIds = $requiredBerkas->pluck('id')->toArray();
                    $missingBerkas = array_diff($requiredBerkasIds, $uploadedBerkasIds);
                    return !empty($missingBerkas) || $jemaah->berkasJemaahs->some(function($berkas) {
                        return $berkas->status != 'diverifikasi' || is_null($berkas->file_path);
                    });
                });
            @endphp

            @if(!$isTripExpired)
            <div class="row justify-content-center my-5">
                <div class="card col-md-6" style="width: 54rem">
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>{{ $item->paket->nama_paket }}</h3>
                            @php
                                    $status = $item->status;
                                    $badgeClass = '';
                                    if ($status == 'Tertunda') {
                                        $badgeClass = 'bg-secondary';
                                    } elseif (in_array($status, ['diterima', 'dikonfirmasi'])) {
                                        $badgeClass = 'bg-success';
                                    } elseif (in_array($status, ['ditolak', 'dibatalkan'])) {
                                        $badgeClass = 'bg-danger';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }} px-3 py-2">{{ ucfirst($status) }}</span>
                            <span class="badge bg-primary">Akan Datang</span>
                        </div>
                        <div class="d-flex align-items-start m-3">
                            <img src="{{ $item->paket->gambar ? asset('storage/' . $item->paket->gambar) : asset('storage/paket-gambar/default.jpg') }}" 
                                 alt="{{ $item->paket->nama_paket }}" 
                                 class="me-3" style="width: 250px; height: auto; border-radius: 8px;">
                            <div class="container">
                                @if ($sisa_hari > 0)
                                    <h3 class="mb-1 text-success">Berangkat {{ $sisa_hari }} hari lagi</h3>
                                @elseif($sisa_hari === 0)
                                    <h3 class="mb-1 text-warning">Berangkat hari ini</h3>
                                @endif

                                <h5 class="mb-1">
                                    Tanggal Perjalanan: 
                                    {{ Carbon::parse($item->paket->tanggal_mulai)->format('d M Y') }} - 
                                    {{ Carbon::parse($item->paket->tanggal_selesai)->format('d M Y') }}
                                </h5>
                                {{-- <h5 class="mb-3 @if($item->is_pembayaran_lunas == 0) text-danger @else text-success @endif">
                                    @if($item->is_pembayaran_lunas == 0)
                                        Tagihan yang belum dibayar: Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                                    @else
                                        Pembayaran Lunas
                                    @endif
                                </h5> --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><i class="fas fa-users me-2"></i>Jumlah Orang: {{ $item->jumlah_orang }} Orang</p>
                                        <p><i class="fas fa-plane-departure me-2"></i>Keberangkatan: {{ ucfirst($item->paket->tempat_keberangkatan) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><i class="fas fa-suitcase me-2"></i>Jenis: {{ ucfirst($item->paket->jenis_paket) }}</p>
                                        <p><i class="fas fa-plane-arrival me-2"></i>Kepulangan: {{ ucfirst($item->paket->tempat_kepulangan) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Document Status Table -->
                        <div class="mt-4">
                            <h5 class="mb-3"><i class="fas fa-folder-open me-2"></i>Status Berkas Jemaah</h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Nama Jemaah</th>
                                            <th>Berkas</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($item->jemaahs as $jemaah)
                                            @php
                                                $uploadedBerkasIds = $jemaah->berkasJemaahs->pluck('berkas_id')->toArray();
                                                $requiredBerkasIds = $requiredBerkas->pluck('id')->toArray();
                                                $missingBerkas = array_diff($requiredBerkasIds, $uploadedBerkasIds);
                                                $allUploaded = empty($missingBerkas);
                                                $allVerified = $allUploaded && $jemaah->berkasJemaahs->every(function($berkas) {
                                                    return $berkas->status == 'diverifikasi' && !is_null($berkas->file_path);
                                                });
                                                $hasPendingOrRejected = $jemaah->berkasJemaahs->some(function($berkas) {
                                                    return in_array($berkas->status, ['tertunda', 'ditolak']) || is_null($berkas->file_path);
                                                });
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $jemaah->nama_lengkap }}</td>
                                                <td>
                                                    @if($allUploaded)
                                                        Semua berkas telah diupload
                                                    @else
                                                        {{ count($uploadedBerkasIds) }} dari {{ count($requiredBerkas) }} berkas diupload
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!$jemaah->berkasJemaahs->count())
                                                        <span class="badge bg-danger text-white">Belum ada berkas</span>
                                                    @elseif($allVerified)
                                                        <span class="badge bg-success text-white">Semua diverifikasi</span>
                                                    @elseif($hasPendingOrRejected)
                                                        <span class="badge bg-warning text-dark">Ada berkas tertunda/ditolak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!$allUploaded)
                                                        <a href="{{ route('pemesanan.jemaah.add-berkas', [$item->id, $jemaah->id]) }}" 
                                                           class="btn btn-primary btn-sm">
                                                            <i class="fas fa-upload me-1"></i> Upload Berkas
                                                        </a>
                                                    @elseif($hasPendingOrRejected)
                                                        <a href="{{ route('pemesanan.jemaah.list', $item->id) }}" 
                                                           class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit me-1"></i> Perbaiki Berkas
                                                        </a>
                                                    @else
                                                        <span class="text-success"><i class="fas fa-check-circle me-1"></i> Lengkap</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex bd-highlight justify-content-end align-items-center mt-3">
                            @if($item->is_pembayaran_lunas == 0 || $hasIncompleteDocuments)
                                <div class="me-auto bd-highlight">
                                    @if($item->is_pembayaran_lunas == 0)
                                        <p class="text-danger">
                                            <i class="fas fa-exclamation-circle me-2"></i>Terdapat tagihan yang belum dilunasi
                                        </p>
                                    @endif
                                    @if($hasIncompleteDocuments)
                                        <p class="text-warning">
                                            <i class="fas fa-file-alt me-2"></i>Terdapat berkas yang belum diverifikasi atau belum lengkap
                                        </p>
                                    @endif
                                </div>
                                @if($item->is_pembayaran_lunas == 0)
                                    <!-- ORIGINAL CODE: Bayar button linked to tagihan -->
                                    <!--
                                    <a href="{{ route('pemesanan.tagihan', $item->id) }}" class="bd-highlight btn btn-success me-2">
                                        <i class="fas fa-credit-card me-2"></i>Bayar
                                    </a>
                                    -->
                                    <!-- MODIFIED CODE: Bayar button links to payment creation form -->
                                    <a href="{{ route('pembayaran.create', $item->id) }}" class="bd-highlight btn btn-success me-2">
                                        <i class="fas fa-credit-card me-2"></i>Bayar
                                    </a>
                                @endif
                                <a href="{{ route('pemesanan.detail', $item->id) }}" class="bd-highlight btn btn-primary">
                                    <i class="fas fa-info-circle me-2"></i>Detail
                                </a>
                            @else
                                <p class="me-auto bd-highlight text-success">
                                    <i class="fas fa-check-circle me-2"></i>Pembayaran dan berkas lengkap
                                </p>
                                <a href="{{ route('pemesanan.detail', $item->id) }}" class="bd-highlight btn btn-primary">
                                    <i class="fas fa-info-circle me-2"></i>Detail
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>Belum ada perjalanan yang dijadwalkan</h4>
                    <p>Anda belum memiliki perjalanan yang akan datang. Silakan pesan perjalanan baru.</p>
                    <a href="{{ route('umroh.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search me-2"></i>Cari Paket Perjalanan
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection