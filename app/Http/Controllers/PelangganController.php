<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index() {
        return view('pelanggan.index', [
            'pesanan' => Pesanan::orderBy('id', 'DESC')->get(),
        ]);
    }
}
