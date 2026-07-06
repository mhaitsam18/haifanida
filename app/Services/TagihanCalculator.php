<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Models\Pemesanan;

class TagihanCalculator
{
    /**
     * Hitung rincian tagihan (invoice) untuk satu pemesanan: daftar item,
     * subtotal, pajak, jumlah yang sudah dibayar, dan sisa saldo.
     *
     * Dipakai bersama oleh AdminTagihanController dan MemberTagihanController
     * supaya admin dan member selalu melihat angka yang identik untuk
     * pemesanan yang sama.
     */
    public function calculate(Pemesanan $pemesanan): array
    {
        $tagihans = [
            [
                'deskripsi' => $pemesanan->paket->nama_paket,
                'jumlah' => $pemesanan->jumlah_orang,
                'biaya_satuan' => $pemesanan->paket->harga,
                'satuan' => 'pax',
                'total' => $pemesanan->paket->harga * $pemesanan->jumlah_orang,
            ],
        ];

        foreach ($pemesanan->pemesananKamars as $pemesananKamar) {
            $tagihans[] = [
                'deskripsi' => $pemesananKamar->tipe_kamar,
                'jumlah' => 1,
                'biaya_satuan' => $pemesananKamar->harga,
                'satuan' => 'pax',
                'total' => $pemesananKamar->harga,
            ];

            foreach ($pemesananKamar->permintaans as $permintaan) {
                $tagihans[] = [
                    'deskripsi' => 'Tambahan : ' . $permintaan->permintaan,
                    'jumlah' => 1,
                    'biaya_satuan' => $permintaan->harga,
                    'satuan' => '',
                    'total' => $permintaan->harga,
                ];
            }
        }

        foreach ($pemesanan->pemesananEkstras as $pemesananEkstra) {
            $tagihans[] = [
                'deskripsi' => $pemesananEkstra->ekstra,
                'jumlah' => $pemesananEkstra->jumlah,
                'biaya_satuan' => $pemesananEkstra->total_harga / $pemesananEkstra->jumlah,
                'satuan' => '',
                'total' => $pemesananEkstra->total_harga,
            ];
        }

        $pembayaran = Pembayaran::where('pemesanan_id', $pemesanan->id)
            ->where('status_pembayaran', 'diterima')
            ->sum('jumlah_pembayaran');

        $subtotal = array_sum(array_column($tagihans, 'total'));
        $taxRate = (float) config('finance.tax_rate', 0);
        $tax = $subtotal * $taxRate / 100;
        $balance = $subtotal + $tax - $pembayaran;

        $pemesanan->is_pembayaran_lunas = $balance <= 0;
        $pemesanan->save();

        return [
            'tagihans' => $tagihans,
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax' => $tax,
            'pembayaran' => $pembayaran,
            'balance' => $balance,
        ];
    }
}
