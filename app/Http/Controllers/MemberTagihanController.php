<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Pemesanan;
use App\Services\TagihanCalculator;

class MemberTagihanController extends Controller
{
    public function index($id, TagihanCalculator $calculator)
    {
        $pemesanan = Pemesanan::where('id', $id)
            ->where('user_id', auth()->id())
            ->with(['paket', 'pemesananKamars.permintaans', 'pemesananEkstras'])
            ->firstOrFail();

        $hasil = $calculator->calculate($pemesanan);

        return view('home.pemesanan.tagihan', [
            'title' => 'Data Pemesanan',
            'page' => 'pemesanan',
            'pemesanan' => $pemesanan,
            'tagihans' => $hasil['tagihans'],
            'subtotal' => $hasil['subtotal'],
            'tax_rate' => $hasil['tax_rate'],
            'tax' => $hasil['tax'],
            'pembayaran' => $hasil['pembayaran'],
            'balance' => $hasil['balance'],
        ]);
    }

    public function tagihanGrup(Grup $grup = null)
    {
        return view('errors.coming-soon', [
            'title' => 'Tagihan Grup',
            'judul' => 'Coming Soon',
            'pesan' => 'Fitur Ini akan segera Hadir',
            'page' => 'tagihan-grup',
        ]);
    }

    /**
     * Unduh rincian tagihan milik sendiri sebagai PDF.
     */
    public function cetak(Pemesanan $pemesanan, TagihanCalculator $calculator)
    {
        if ($pemesanan->user_id !== auth()->id()) {
            abort(403);
        }

        $hasil = $calculator->calculate($pemesanan);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.tagihan', [
            'pemesanan' => $pemesanan,
            'tagihans' => $hasil['tagihans'],
            'subtotal' => $hasil['subtotal'],
            'tax_rate' => $hasil['tax_rate'],
            'tax' => $hasil['tax'],
            'pembayaran' => $hasil['pembayaran'],
            'balance' => $hasil['balance'],
        ]);

        return $pdf->download('invoice-' . $pemesanan->id . '.pdf');
    }
}
