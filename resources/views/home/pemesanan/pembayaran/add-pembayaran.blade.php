@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">Tambah Pembayaran</h2>
            <p class="text-muted">Silakan isi informasi pembayaran dengan benar</p>
        </div>
    </div>

    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-2">
                        <h5 class="mb-0">
                            <i class="fas fa-money-check-alt me-2"></i>
                            Data Pembayaran
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="jumlah_pembayaran" class="form-label fw-semibold">Jumlah Pembayaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="jumlah_pembayaran" name="jumlah_pembayaran" required placeholder="Masukkan jumlah pembayaran">
                        </div>

                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" required placeholder="Masukkan metode pembayaran (Qris, transfer bank, dll)">
                        </div>
                        
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label fw-semibold">Bukti Pembayaran <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan / Catatan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan atau catatan tambahan (opsional)"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center mt-3">
            <div class="col-md-8 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </button>
                <div>
                    <button type="reset" class="btn btn-light me-2">
                        <i class="fas fa-redo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection