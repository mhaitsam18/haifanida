<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Pemesanan;
use App\Services\TagihanCalculator;

class AdminTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pemesanan $pemesanan, TagihanCalculator $calculator)
    {
        $hasil = $calculator->calculate($pemesanan);

        return view('admin.paket.pemesanan.tagihan', [
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
        // return view('admin.paket.grup.tagihan', [
        //     'title' => 'Tagihan Grup',
        //     'page' => 'tagihan-grup',
        // ]);
    }

    /**
     * Unduh rincian tagihan sebagai PDF.
     */
    public function cetak(Pemesanan $pemesanan, TagihanCalculator $calculator)
    {
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
