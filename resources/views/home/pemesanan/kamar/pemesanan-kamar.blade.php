@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">Pemesanan Kamar</h2>
            <p class="text-muted">Silakan isi informasi pemesanan kamar dengan benar</p>
        </div>
    </div>

    <form action="" method="POST">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-2">
                        <h5 class="mb-0">
                            <i class="fas fa-bed me-2"></i>
                            Data Pemesanan Kamar
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="room_type" class="form-label fw-semibold">Tipe Kamar <span class="text-danger">*</span></label>
                            <select class="form-select" id="room_type" name="room_type" required onchange="updateRoomDetails()">
                                <option value="" selected disabled>-- Pilih Tipe Kamar --</option>
                                <option value="standard" data-capacity="2" data-price="500000">Kamar Standard (2 orang)</option>
                                <option value="deluxe" data-capacity="2" data-price="750000">Kamar Deluxe (2 orang)</option>
                                <option value="family" data-capacity="4" data-price="1200000">Kamar Family (4 orang)</option>
                                <option value="suite" data-capacity="2" data-price="1500000">Suite (2 orang)</option>
                                <option value="royal_suite" data-capacity="4" data-price="2500000">Royal Suite (4 orang)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label fw-semibold">Jumlah Pengisi <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="capacity" name="capacity" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="price" name="price" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold">Keterangan / Catatan</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Masukkan keterangan tambahan (opsional)"></textarea>
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
                        <i class="fas fa-save me-1"></i>Simpan Pemesanan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomTypeSelect = document.getElementById('room_type');
        const capacityInput = document.getElementById('capacity');
        const priceInput = document.getElementById('price');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(parseInt(number));
        }

        function updateRoomDetails() {
            const selectedOption = roomTypeSelect.options[roomTypeSelect.selectedIndex];

            if (selectedOption.value) {
                const capacity = selectedOption.getAttribute('data-capacity') || 0;
                const price = selectedOption.getAttribute('data-price') || 0;

                capacityInput.value = capacity;
                priceInput.value = formatRupiah(price);
            } else {
                capacityInput.value = '';
                priceInput.value = '';
            }
        }

        roomTypeSelect.addEventListener('change', updateRoomDetails);
    });
</script>
@endsection