<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index(Request $request) {
        // dd(Paket::all());

        return view('landing-page.daftar-paket', [
            'paket' => Paket::all(),
        ]);
    }

    public function show(Paket $paket) {
        dd($paket);
        return view('landing-page.paket', [
            'paket' => $paket,
        ]);
    }
}
