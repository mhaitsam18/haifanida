@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/berkas/berkas-jemaah.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-2">BERKAS JEMAAH</h2>
            <p class="fs-5 fw-bold" style="color: #4e73df;">{{ $jemaah->nama_lengkap }}</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('pemesanan.jemaah.add-berkas', [$pemesanan->id, $jemaah->id]) }}" 
               class="btn btn-primary me-2 px-4 py-2">
                <i class="fas fa-plus-circle me-2"></i>Tambah Berkas
            </a>
            <a href="{{ route('pemesanan.jemaah.list', $pemesanan->id) }}" 
               class="btn btn-outline-secondary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Container -->
    <div class="card shadow border-0">
        <div class="card-header bg-light border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-secondary fw-semibold">Daftar Berkas</h4>
                <span class="badge bg-info text-white px-3 py-2">Total: {{ $berkasJemaahs->count() }} berkas</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if($berkasJemaahs->count() > 0)
                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th class="px-4 py-3" width="5%">#</th>
                                <th class="px-4 py-3" width="25%">Nama Berkas</th>
                                <th class="px-4 py-3" width="20%">File</th>
                                <th class="px-4 py-3" width="15%">Status</th>
                                <th class="px-4 py-3" width="15%">Tanggal Upload</th>
                                <th class="px-4 py-3" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berkasJemaahs as $berkasJemaah)
                                <tr class="align-middle">
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td class="px-4">
                                        <div class="fw-semibold">{{ $berkasJemaah->berkas->nama_berkas }}</div>
                                        @if($berkasJemaah->berkas->keterangan)
                                            <small class="text-muted">{{ $berkasJemaah->berkas->keterangan }}</small>
                                        @endif
                                    </td>
                                    <td class="px-4">
                                        @if($berkasJemaah->file_path)
                                            @php
                                                $fileExtension = pathinfo($berkasJemaah->file_path, PATHINFO_EXTENSION);
                                                $fileName = basename($berkasJemaah->file_path);
                                            @endphp
                                            <div class="d-flex align-items-center mb-2">
                                                @if(strtolower($fileExtension) == 'pdf')
                                                    <i class="fas fa-file-pdf text-danger me-2 fa-2x"></i>
                                                @elseif(in_array(strtolower($fileExtension), ['doc', 'docx']))
                                                    <i class="fas fa-file-word text-primary me-2 fa-2x"></i>
                                                @else
                                                    <i class="fas fa-file text-secondary me-2 fa-2x"></i>
                                                @endif
                                                <div>
                                                    <div class="small fw-semibold">{{ strtoupper($fileExtension) }} File</div>
                                                    <div class="small text-muted">{{ substr($fileName, 0, 20) }}...</div>
                                                </div>
                                            </div>
                                            <a href="{{ route('pemesanan.jemaah.berkas.preview', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" 
                                               target="_blank" class="btn btn-sm btn-outline-primary px-3 py-2">
                                                <i class="fas fa-eye me-1"></i> Lihat
                                            </a>
                                        @else
                                            <div class="text-center">
                                                <i class="fas fa-file-slash text-muted fa-2x mb-2"></i>
                                                <div class="small text-muted">Belum ada file</div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4">
                                        @if($berkasJemaah->status == 'diverifikasi')
                                            <span class="badge bg-success text-white px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>Diverifikasi
                                            </span>
                                        @elseif($berkasJemaah->status == 'ditolak')
                                            <span class="badge bg-danger text-white px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>Ditolak
                                            </span>
                                            @if($berkasJemaah->catatan)
                                                <div class="small text-danger mt-1">
                                                    <i class="fas fa-exclamation-triangle me-1"></i> {{ $berkasJemaah->catatan }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="fas fa-clock me-1"></i>Tertunda
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ Carbon::parse($berkasJemaah->created_at)->format('d/m/Y') }}
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ Carbon::parse($berkasJemaah->created_at)->format('H:i') }}
                                        </small>
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex gap-2">
                                            @if($berkasJemaah->status != 'diverifikasi')
                                                <a href="{{ route('pemesanan.jemaah.berkas.edit', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" 
                                                   class="btn btn-sm btn-outline-warning px-3 py-2">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                            @endif
                                            <form action="{{ route('pemesanan.jemaah.berkas.destroy', [$pemesanan->id, $jemaah->id, $berkasJemaah->id]) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger px-3 py-2"
                                                        {{ $berkasJemaah->status == 'diverifikasi' ? 'disabled' : '' }}
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus berkas ini? Tindakan ini tidak dapat dibatalkan.');">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted mb-2">Belum ada berkas yang diupload</h5>
                        <p class="text-muted mb-4">
                            Silahkan upload berkas yang diperlukan untuk melengkapi pendaftaran Anda.
                        </p>
                        <a href="{{ route('pemesanan.jemaah.add-berkas', [$pemesanan->id, $jemaah->id]) }}" 
                           class="btn btn-success btn-lg px-4 py-2">
                            <i class="fas fa-plus me-2"></i> Upload Berkas Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Status Info -->
    <div class="alert alert-info mt-4 shadow-sm">
        <div class="d-flex align-items-start">
            <i class="fas fa-info-circle me-2 mt-1 fa-lg"></i>
            <div>
                <h6 class="alert-heading mb-2 fw-semibold">Status Berkas</h6>
                <ul class="mb-0 small">
                    <li><strong>Tertunda:</strong> Berkas sedang menunggu verifikasi</li>
                    <li><strong>Diverifikasi:</strong> Berkas telah diverifikasi dan diterima</li>
                    <li><strong>Ditolak:</strong> Berkas tidak memenuhi kriteria</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection