@extends('layouts.main')

@php use Illuminate\Support\Str; @endphp

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>{{ $title }}</h3>
                <ul>
                    <li><a href="/home">Home</a></li>
                    <li><i class='bx bx-chevrons-right'></i></li>
                    <li><a href="/umroh">Paket Umroh</a></li>
                    <li><i class='bx bx-chevrons-right'></i></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
        <div class="inner-shape">
            <img src="/assets-techex-demo/images/shape/inner-shape.png" alt="Images">
        </div>
    </div>

    <div class="service-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-article">
                        <div class="service-article-img">
                            @if($paket->gambar)
                            <img src="{{ asset('storage/' . $paket->gambar) }}" alt="Gambar Paket" style="max-height: 400px; width: 100%; object-fit: contain; border-radius: 10px; background: #f8f8f8;">
                            @else
                                <img src="/assets-techex-demo/images/services/service-details.jpg" alt="{{ $paket->nama_paket }}" style="max-height: 400px; width: 100%; object-fit: cover; border-radius: 10px;">
                            @endif
                        </div>

                        <div class="service-article-title">
                            <h2>{{ $paket->nama_paket }}</h2>
                        </div>

                        <div class="service-article-content">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-map'></i> Destinasi</h5>
                                        <p style="margin: 0;">{{ $paket->destinasi }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-time'></i> Durasi</h5>
                                        <p style="margin: 0;">{{ $paket->durasi }} Hari</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-calendar'></i> Tanggal Keberangkatan</h5>
                                        <p style="margin: 0;">{{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bx-calendar'></i> Tanggal Kepulangan</h5>
                                        <p style="margin: 0;">{{ Carbon::parse($paket->tanggal_selesai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bxs-plane-take-off'></i> Keberangkatan dari</h5>
                                        <p style="margin: 0;">{{ $paket->tempat_keberangkatan }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                                        <h5 style="font-size: 16px; margin-bottom: 8px;"><i class='bx bxs-plane-land'></i> Kepulangan ke</h5>
                                        <p style="margin: 0;">{{ $paket->tempat_kepulangan }}</p>
                                    </div>
                                </div>
                            </div>

                            <h3>Deskripsi Paket</h3>
                            <p>{!! nl2br(e($paket->deskripsi)) !!}</p>

                            <h3>Fasilitas</h3>
                            <div class="facilities-content">
                                {!! $paket->fasilitas !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-wrap">
                        <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px; text-align: center;">
                            <h3>Harga Paket</h3>
                            <div style="margin: 15px 0;">
                                <h2 style="font-size: 32px; color: #ff5d22; margin-bottom: 0;">
                                    Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                </h2>
                                <span>per orang</span>
                            </div>
                            <a href="{{ route('umroh.formPemesanan', ['paket_id' => $paket->id]) }}" class="default-btn btn-bg-two border-radius-5 w-100 mt-3">
                                Pesan Sekarang
                            </a>
                            
                            <!-- WhatsApp Share Button -->
                            <div class="mt-3 text-center">
                                <a href="#" id="shareWhatsAppBtn" class="btn btn-success w-100 d-flex justify-content-center align-items-center" 
                                        style="background-color: #25D366; border: none;">
                                    <i class='bx bxl-whatsapp me-2' style="font-size: 22px;"></i> Bagikan via WhatsApp
                                </a>
                            </div>
                        </div>

                        <div class="services-bar">
                            <h3 class="title">Paket Lainnya</h3>
                            <div class="services-bar-widget">
                                <ul>
                                    @foreach(App\Models\Paket::where('jenis_paket', $paket->jenis_paket)
                                            ->where('id', '!=', $paket->id)
                                            ->where('published_at', '!=', null)
                                            ->latest()
                                            ->take(5)
                                            ->get() as $otherPaket)
                                        <li>
                                            <a href="/paket/{{ $otherPaket->id }}">
                                                {{ $otherPaket->nama_paket }}
                                                <i class='bx bx-chevron-right'></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Share Modal -->
    <div class="modal fade" id="whatsappShareModal" tabindex="-1" aria-labelledby="whatsappShareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="whatsappShareModalLabel">Bagikan via WhatsApp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="whatsappNumber" class="form-label">Nomor WhatsApp (opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text">+62</span>
                            <input type="tel" class="form-control" id="whatsappNumber" placeholder="81234567890 (tanpa awalan 0)">
                        </div>
                        <div class="form-text">Jika dibiarkan kosong, Anda bisa memilih kontak di WhatsApp</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pesan yang akan dibagikan:</label>
                        <div class="p-3" style="background: #f8f9fa; border-radius: 8px; max-height: 300px; overflow-y: auto;">
                            <pre id="messagePreview" style="white-space: pre-wrap; font-family: inherit; margin-bottom: 0;">@php
                            $message = "🕋 Bismillah, aku mau daftar Umroh di PT. Haifa Nida Wisata Karawang! 
Berikut detail paket yang aku pilih:

✈ " . $paket->nama_paket . "
📆 Keberangkatan: " . Carbon::parse($paket->tanggal_mulai)->format('d M Y') . "
⏱ Durasi: " . $paket->durasi . " Hari
🌐 Destinasi: " . $paket->destinasi . "
💰 Harga: Rp " . number_format($paket->harga, 0, ',', '.') . "/orang

Deskripsi " . Str::limit(strip_tags($paket->deskripsi), 200) . "
" . Str::limit(strip_tags($paket->fasilitas), 200) . "

🙋‍♂ Tertarik juga? Bisa langsung hubungi admin PT. Haifa:
📱 WhatsApp: https://wa.me/6282299198002
📍 Kantor: Jl. Raya Karawang No. 88";
                            echo e($message);
                            @endphp</pre>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="sendWhatsAppBtn">
                        <i class='bx bxl-whatsapp me-1'></i> Kirim via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const shareWhatsAppBtn = document.getElementById('shareWhatsAppBtn');
        
        shareWhatsAppBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Generate the message with proper emojis
            const message = `🕋 Bismillah, aku mau daftar Umroh di PT. Haifa Nida Wisata Karawang!
Berikut detail paket yang aku pilih:

✈️ {{ $paket->nama_paket }}
📆 Keberangkatan: {{ Carbon::parse($paket->tanggal_mulai)->format('d M Y') }}
⏱️ Durasi: {{ $paket->durasi }} Hari
🌐 Destinasi: {{ $paket->destinasi }}
💰 Harga: Rp {{ number_format($paket->harga, 0, ',', '.') }}/orang

{{ Str::limit(strip_tags($paket->deskripsi), 200) }}
{{ Str::limit(strip_tags($paket->fasilitas), 200) }}

🙋‍♂️ Tertarik juga? Bisa langsung hubungi admin PT. Haifa:
📱 WhatsApp: https://wa.me/6282299198002
📍 Kantor: Jl. Raya Karawang No. 88`;
            
            // Encode message for URL
            const encodedMessage = encodeURIComponent(message);
            
            // Direct to WhatsApp's share interface
            const whatsappLink = `https://api.whatsapp.com/send?text=${encodedMessage}`;
            window.open(whatsappLink, '_blank');
        });
    });
    </script>
@endsection