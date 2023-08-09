<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PelangganPaketController extends Controller
{
    public function create(Paket $paket) {
        return view('landing-page.pesan-paket', [
            'paket' => $paket,
        ]);
    }

    public function store(Request $request) {
        dd($request->input());
    }
}
