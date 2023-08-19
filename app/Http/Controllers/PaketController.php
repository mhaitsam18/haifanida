<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index() {
        return view('landing-page.daftar-paket', [
            'paket' => Paket::all(),
        ]);
    }

    public function show(Paket $paket) {
        return view('landing-page.paket', [
            'paket' => $paket,
            'jadwal' => Catatan::where('kategori_catatan_id', 4)->get(),
            'barangBoleh' => Catatan::where('kategori_catatan_id', 1)->get(),
            'barangDilarang' => Catatan::where('kategori_catatan_id', 2)->get(),
        ]);
    }
}
