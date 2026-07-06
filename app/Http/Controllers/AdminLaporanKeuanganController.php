<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Services\TagihanCalculator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminLaporanKeuanganController extends Controller
{
    /**
     * Tampilkan laporan pemasukan bulanan per status pembayaran
     * dan daftar saldo tertunggak lintas pemesanan.
     */
    public function index()
    {
        $tahun = now()->year;

        $pemasukanPerBulan = Pembayaran::selectRaw('MONTH(tanggal_pembayaran) as bulan, status_pembayaran, SUM(jumlah_pembayaran) as total')
            ->whereYear('tanggal_pembayaran', $tahun)
            ->groupBy('bulan', 'status_pembayaran')
            ->get()
            ->groupBy('bulan');

        $saldoTertunggak = $this->hitungSaldoTertunggak();

        return view('admin.laporan-keuangan.index', [
            'title' => 'Laporan Keuangan',
            'page' => 'laporan-keuangan',
            'tahun' => $tahun,
            'pemasukanPerBulan' => $pemasukanPerBulan,
            'saldoTertunggak' => $saldoTertunggak,
            'totalTertunggak' => $saldoTertunggak->sum('balance'),
        ]);
    }

    /**
     * Unduh daftar saldo tertunggak sebagai CSV.
     */
    public function exportCsv(): StreamedResponse
    {
        $saldoTertunggak = $this->hitungSaldoTertunggak();

        return response()->streamDownload(function () use ($saldoTertunggak) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID Pemesanan', 'Nama Pemesan', 'Paket', 'Status', 'Total Tagihan', 'Sudah Dibayar', 'Saldo Tertunggak']);

            foreach ($saldoTertunggak as $item) {
                fputcsv($handle, [
                    $item['pemesanan']->id,
                    $item['pemesanan']->user->name ?? '-',
                    $item['pemesanan']->paket->nama_paket ?? '-',
                    $item['pemesanan']->status,
                    number_format($item['subtotal'] + $item['tax'], 2, '.', ''),
                    number_format($item['pembayaran'], 2, '.', ''),
                    number_format($item['balance'], 2, '.', ''),
                ]);
            }

            fclose($handle);
        }, 'laporan-saldo-tertunggak-' . now()->format('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    /**
     * Hitung saldo tertunggak untuk setiap pemesanan aktif (bukan ditolak/dibatalkan).
     */
    private function hitungSaldoTertunggak()
    {
        $calculator = app(TagihanCalculator::class);

        return Pemesanan::whereNotIn('status', ['ditolak', 'dibatalkan'])
            ->with(['paket', 'user', 'pemesananKamars.permintaans', 'pemesananEkstras'])
            ->get()
            ->map(function (Pemesanan $pemesanan) use ($calculator) {
                $hasil = $calculator->calculate($pemesanan);

                return array_merge($hasil, ['pemesanan' => $pemesanan]);
            })
            ->filter(fn ($item) => $item['balance'] > 0)
            ->values();
    }
}
