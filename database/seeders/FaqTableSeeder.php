<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

/**
 * Seeds the FAQ table with the exact Q&A content that previously lived
 * hardcoded in resources/views/home/faq.blade.php — nothing invented,
 * nothing dropped.
 */
class FaqTableSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'pertanyaan' => 'Apa itu Paket Umroh Reguler?',
                'jawaban' => 'Paket Umroh Reguler adalah program perjalanan ibadah umroh dengan jadwal tetap, akomodasi standar, dan fasilitas lengkap untuk kenyamanan jamaah. Paket ini cocok untuk Anda yang ingin beribadah dengan biaya terjangkau.',
            ],
            [
                'pertanyaan' => 'Apa Saja Dokumen yang Diperlukan untuk Umroh?',
                'jawaban' => 'Dokumen yang diperlukan meliputi paspor yang masih berlaku minimal 6 bulan, kartu identitas, akta kelahiran (jika diperlukan), serta bukti vaksin meningitis. Kami akan membantu proses pengurusannya.',
            ],
            [
                'pertanyaan' => 'Bagaimana Cara Memastikan Keamanan Selama Perjalanan?',
                'jawaban' => 'Kami bekerja sama dengan penyedia layanan terpercaya di Arab Saudi untuk memastikan keamanan jamaah, mulai dari transportasi, akomodasi, hingga pendampingan selama ibadah.',
            ],
            [
                'pertanyaan' => 'Apa Perbedaan Umroh dan Haji?',
                'jawaban' => 'Umroh adalah ibadah yang dapat dilakukan kapan saja, sedangkan haji memiliki waktu tertentu di bulan Dzulhijjah. Umroh juga tidak wajib, berbeda dengan haji yang merupakan rukun Islam kelima bagi yang mampu.',
            ],
            [
                'pertanyaan' => 'Bagaimana Cara Kami Membantu Perjalanan Umroh Anda?',
                'jawaban' => 'Kami menyediakan layanan lengkap mulai dari pengurusan dokumen, pemesanan tiket, akomodasi, hingga pembimbingan ibadah agar perjalanan Anda lancar dan khusyuk.',
            ],
            [
                'pertanyaan' => 'Mengapa Memilih Paket Umroh VIP?',
                'jawaban' => 'Paket Umroh VIP menawarkan akomodasi bintang 5, transportasi eksklusif, dan jadwal ibadah yang lebih fleksibel untuk pengalaman ibadah yang lebih nyaman dan pribadi.',
            ],
            [
                'pertanyaan' => 'Bagaimana Proses Pendaftaran Umroh?',
                'jawaban' => 'Anda cukup menghubungi kami, mengisi formulir pendaftaran, melengkapi dokumen, dan melakukan pembayaran. Tim kami akan memandu setiap langkahnya.',
            ],
            [
                'pertanyaan' => 'Apakah Ada Pembimbing Selama Umroh?',
                'jawaban' => 'Ya, setiap rombongan didampingi oleh pembimbing berpengalaman yang akan membantu jamaah dalam melaksanakan ibadah umroh sesuai tuntunan syariat.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::firstOrCreate(
                ['pertanyaan' => $faq['pertanyaan']],
                [
                    'jawaban' => $faq['jawaban'],
                    'kategori' => 'Umroh',
                    'urutan' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
