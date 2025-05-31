@extends('layouts.main')

@section('content')
<div class="container py-4 mb-5">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-0 text-primary">{{ $title }}</h2>
            <p class="text-muted">Silakan isi informasi pemesanan kamar dengan benar</p>
        </div>
    </div>

    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('pemesanan.kamar.store') }}" method="POST">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-bed me-2"></i>
                            Data Pemesanan Kamar
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="tipe_kamar" class="form-label fw-semibold">Tipe Kamar <span class="text-danger">*</span></label>
                            <select class="form-select @error('tipe_kamar') is-invalid @enderror" id="tipe_kamar" name="tipe_kamar" required>
                                <option value="" selected disabled>Pilih Tipe Kamar</option>
                                @foreach ($kamars as $kamar)
                                    <option value="{{ $kamar->nama_ekstra }}"
                                        data-harga="{{ $kamar->harga_default }}"
                                        data-keterangan="{{ $kamar->keterangan }}" 
                                        @selected($kamar->nama_ekstra == old('tipe_kamar'))>
                                        {{ $kamar->nama_ekstra }} |
                                        Rp.{{ number_format($kamar->harga_default, 0, ',', '.') }} |
                                        {{ $kamar->deskripsi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipe_kamar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- DEBUG INFO START -->
                            <div class="mt-3 p-3 bg-light border rounded">
                                <strong>🔍 DEBUG INFO - Data Kamar:</strong>
                                <div class="mt-2">
                                    <small class="text-muted">Total data kamar: {{ count($kamars) }}</small>
                                </div>
                                @if(count($kamars) > 0)
                                    <div class="table-responsive mt-2">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Kamar</th>
                                                    <th>Jenis Ekstra</th>
                                                    <th>Harga Default</th>
                                                    <th>Deskripsi</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kamars as $kamar)
                                                <tr>
                                                    <td>{{ $kamar->id ?? 'NULL' }}</td>
                                                    <td>{{ $kamar->nama_ekstra ?? 'NULL' }}</td>
                                                    <td>{{ $kamar->jenis_ekstra ?? 'NULL' }}</td>
                                                    <td>
                                                        @if($kamar->harga_default)
                                                            <span class="text-success">Rp {{ number_format($kamar->harga_default, 0, ',', '.') }}</span>
                                                            <br><small class="text-muted">Raw: {{ $kamar->harga_default }}</small>
                                                        @else
                                                            <span class="text-danger">NULL/KOSONG</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($kamar->deskripsi)
                                                            <small>{{ Str::limit($kamar->deskripsi, 50) }}</small>
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($kamar->keterangan)
                                                            <small>{{ Str::limit($kamar->keterangan, 50) }}</small>
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                
                                <!-- Debug Raw Data -->
                                <details class="mt-3">
                                    <summary class="text-primary" style="cursor: pointer;">📋 Raw Data (JSON)</summary>
                                    <pre class="mt-2 p-2 bg-dark text-light rounded" style="font-size: 11px; max-height: 200px; overflow-y: auto;">{{ json_encode($kamars->toArray(), JSON_PRETTY_PRINT) }}</pre>
                                </details>

                            <!-- DEBUG INFO END -->

                        <div class="mb-3">
                            <label for="jumlah_pengisi" class="form-label fw-semibold">Jumlah Pengisi</label>
                            <input type="number" class="form-control @error('jumlah_pengisi') is-invalid @enderror" 
                                id="jumlah_pengisi" name="jumlah_pengisi" value="{{ old('jumlah_pengisi') }}" 
                                placeholder="Jumlah Pengisi" readonly>
                            @error('jumlah_pengisi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small id="keterangan_description" class="text-muted"></small>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label fw-semibold">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                    id="harga" name="harga" value="{{ old('harga') }}" 
                                    placeholder="Total Harga" readonly>
                            </div>
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan / Catatan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                id="keterangan" name="keterangan" rows="3" 
                                placeholder="Masukkan keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 d-flex justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
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
    console.log('🚀 Memulai script pemesanan kamar...');
    
    // Ambil elemen-elemen yang dibutuhkan
    const tipeKamarSelect = document.getElementById('tipe_kamar');
    const jumlahPengisiInput = document.getElementById('jumlah_pengisi');
    const hargaInput = document.getElementById('harga');

    // Validasi elemen ada atau tidak
    if (!tipeKamarSelect) {
        console.error('❌ Element tipe_kamar tidak ditemukan!');
        return;
    }
    if (!jumlahPengisiInput) {
        console.error('❌ Element jumlah_pengisi tidak ditemukan!');
        return;
    }
    if (!hargaInput) {
        console.error('❌ Element harga tidak ditemukan!');
        return;
    }

    console.log('✅ Semua element berhasil ditemukan');

    // Debug: Tampilkan semua option yang tersedia
    console.log('📋 Options yang tersedia:');
    for (let i = 0; i < tipeKamarSelect.options.length; i++) {
        const option = tipeKamarSelect.options[i];
        console.log(`${i}: ${option.value} | Harga: ${option.getAttribute('data-harga')} | Deskripsi: ${option.getAttribute('data-deskripsi')}`);
    }

    // Set jumlah pengisi readonly by default
    jumlahPengisiInput.readOnly = true;

    // Function untuk format rupiah
    function formatRupiah(number) {
        if (!number && number !== 0) return '';
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }

    // Function untuk menentukan jumlah pengisi berdasarkan data dari tabel ekstra
async function getJumlahPengisi(namaEkstra) {
    try {
        console.log('🔍 Mencari jumlah pengisi untuk:', namaEkstra);
        
        // Query ke tabel ekstra berdasarkan nama_ekstra dan jenis_ekstra
        const query = `
            SELECT deskripsi, keterangan 
            FROM ekstra 
            WHERE nama_ekstra = ? 
            AND jenis_ekstra = 'tipe kamar'
            LIMIT 1
        `;
        
        const result = await db.query(query, [namaEkstra]);
        
        if (result.length > 0) {
            const deskripsi = result[0].deskripsi;
            const keterangan = result[0].keterangan;
            
            console.log('✅ Data tipe kamar ditemukan:', { deskripsi, keterangan });
            
            // Parsing deskripsi berdasarkan data yang ada
            if (deskripsi) {
                // Untuk quad gabung: "1,2,3,4" -> return empty (user input manual)
                if (deskripsi.includes(',')) {
                    console.log('📝 Tipe kamar fleksibel, memerlukan input manual');
                    return ''; // User pilih sendiri dari range yang tersedia
                }
                
                // Untuk tipe lain: "1", "2", "3", "4" -> return value
                const jumlahPengisi = deskripsi.trim();
                console.log('✅ Jumlah pengisi ditemukan:', jumlahPengisi);
                return jumlahPengisi;
            }
        }
        
        console.log('⚠️ Data tipe kamar tidak ditemukan, menggunakan input manual');
        return ''; // Default: user input manual
        
    } catch (error) {
        console.error('❌ Error mengambil jumlah pengisi:', error);
        return ''; // Fallback ke input manual jika ada error
    }
}

// Function alternatif jika ingin mengembalikan range untuk tipe gabung
async function getJumlahPengisiWithRange(namaEkstra) {
    try {
        console.log('🔍 Mencari jumlah pengisi untuk:', namaEkstra);
        
        const query = `
            SELECT deskripsi, keterangan 
            FROM ekstra 
            WHERE nama_ekstra = ? 
            AND jenis_ekstra = 'tipe kamar'
            LIMIT 1
        `;
        
        const result = await db.query(query, [namaEkstra]);
        
        if (result.length > 0) {
            const deskripsi = result[0].deskripsi;
            const keterangan = result[0].keterangan;
            
            console.log('✅ Data tipe kamar ditemukan:', { deskripsi, keterangan });
            
            if (deskripsi) {
                // Untuk quad gabung: "1,2,3,4" -> return array [1,2,3,4]
                if (deskripsi.includes(',')) {
                    const range = deskripsi.split(',').map(num => num.trim());
                    console.log('📋 Range pengisi tersedia:', range);
                    return {
                        type: 'range',
                        values: range,
                        description: keterangan
                    };
                }
                
                // Untuk tipe fixed: "1", "2", "3", "4" -> return fixed value
                const jumlahPengisi = deskripsi.trim();
                console.log('✅ Jumlah pengisi fixed:', jumlahPengisi);
                return {
                    type: 'fixed',
                    value: jumlahPengisi,
                    description: keterangan
                };
            }
        }
        
        console.log('⚠️ Data tipe kamar tidak ditemukan');
        return null;
        
    } catch (error) {
        console.error('❌ Error mengambil jumlah pengisi:', error);
        return null;
    }
}

// Function untuk mendapatkan semua tipe kamar dengan jumlah pengisi
async function getAllTipeKamarWithPengisi() {
    try {
        const query = `
            SELECT nama_ekstra, deskripsi, keterangan, harga_default
            FROM ekstra 
            WHERE jenis_ekstra = 'tipe kamar'
            ORDER BY nama_ekstra
        `;
        
        const result = await db.query(query);
        
        return result.map(row => ({
            nama: row.nama_ekstra,
            jumlah_pengisi: row.deskripsi,
            keterangan: row.keterangan,
            harga_default: row.harga_default,
            is_flexible: row.deskripsi && row.deskripsi.includes(',')
        }));
        
    } catch (error) {
        console.error('❌ Error mengambil data tipe kamar:', error);
        return [];
    }
}

// Contoh penggunaan
async function contohPenggunaan() {
    // Test untuk berbagai tipe kamar
    const tipeKamarList = [
        'tipe kamar single',
        'tipe kamar double keluarga', 
        'tipe kamar quad gabung',
        'tipe kamar quad keluarga isi 3 dan 1 bed kosong'
    ];
    
    for (const tipe of tipeKamarList) {
        console.log(`\n--- Testing: ${tipe} ---`);
        
        // Method 1: Simple
        const jumlah = await getJumlahPengisi(tipe);
        console.log('Simple result:', jumlah || 'Input manual required');
        
        // Method 2: With range info
        const detail = await getJumlahPengisiWithRange(tipe);
        console.log('Detail result:', detail);
    }
    
    // Get all tipe kamar
    console.log('\n--- Semua Tipe Kamar ---');
    const allTipe = await getAllTipeKamarWithPengisi();
    console.table(allTipe);
}

    // Function utama untuk update form
    function updateFormFields() {
        console.log('🔄 Mengupdate form fields...');
        
        const selectedIndex = tipeKamarSelect.selectedIndex;
        
        if (selectedIndex <= 0) {
            console.log('❌ Tidak ada pilihan yang valid');
            jumlahPengisiInput.value = '';
            hargaInput.value = '';
            jumlahPengisiInput.readOnly = true;
            return;
        }

        const selectedOption = tipeKamarSelect.options[selectedIndex];
        const tipeKamar = selectedOption.value;
        const hargaRaw = selectedOption.getAttribute('data-harga');
        
        console.log('📊 Data yang dipilih:');
        console.log('- Tipe Kamar:', tipeKamar);
        console.log('- Harga Raw:', hargaRaw);

        // Update jumlah pengisi
        const jumlahPengisi = getJumlahPengisi(tipeKamar);
        
        if (jumlahPengisi === '') {
            // Untuk tipe kamar yang memerlukan input manual (quad gabung)
            jumlahPengisiInput.value = '';
            jumlahPengisiInput.readOnly = false;
            jumlahPengisiInput.placeholder = 'Masukkan jumlah pengisi (1-4)';
            console.log('⚠️ Jumlah pengisi: Manual input untuk', tipeKamar);
        } else {
            jumlahPengisiInput.value = jumlahPengisi;
            jumlahPengisiInput.readOnly = true;
            jumlahPengisiInput.placeholder = 'Jumlah Pengisi';
            console.log('✅ Jumlah pengisi diset ke:', jumlahPengisi);
        }

        // Update harga
        if (hargaRaw && hargaRaw.trim() !== '' && hargaRaw !== '0') {
            // Bersihkan string harga dari karakter non-numeric
            const hargaClean = hargaRaw.toString().replace(/[^\d]/g, '');
            const hargaNumber = parseInt(hargaClean);
            
            console.log('💰 Processing harga:', hargaRaw, '→', hargaClean, '→', hargaNumber);
            
            if (!isNaN(hargaNumber) && hargaNumber > 0) {
                const formattedHarga = formatRupiah(hargaNumber);
                hargaInput.value = formattedHarga;
                console.log('✅ Harga berhasil diset ke:', formattedHarga);
            } else {
                hargaInput.value = '';
                console.warn('❌ Harga tidak valid setelah parsing:', hargaNumber);
            }
        } else {
            hargaInput.value = '';
            console.warn('❌ Harga kosong atau tidak tersedia');
        }

        console.log('✅ Update form selesai');
    }

    // Event listener untuk perubahan tipe kamar
    tipeKamarSelect.addEventListener('change', function(e) {
        console.log('🎯 Tipe kamar berubah ke:', e.target.value);
        updateFormFields();
    });

    // Event listener untuk reset form
    const resetButton = document.querySelector('button[type="reset"]');
    if (resetButton) {
        resetButton.addEventListener('click', function() {
            console.log('🔄 Form direset');
            setTimeout(() => {
                jumlahPengisiInput.readOnly = true;
                jumlahPengisiInput.placeholder = 'Jumlah Pengisi';
            }, 100);
        });
    }

    // Trigger update jika ada value yang sudah terpilih (untuk old input)
    if (tipeKamarSelect.value && tipeKamarSelect.value !== '') {
        console.log('🔄 Triggering initial update untuk value:', tipeKamarSelect.value);
        setTimeout(updateFormFields, 100);
    }

    console.log('✅ Script berhasil diinisialisasi');
});
</script>
@endsection