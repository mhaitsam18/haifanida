<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PelangganPesananController extends Controller
{
    public function index() {
        return view('pelanggan.pesanan', [
            'pesanan' => Pesanan::where('pelanggan_id', auth()->user()->id)->get(),
        ]);
    }

    public function show(Pesanan $pesanan) {
        dd($pesanan);
    }
}
