<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index()
    {
        return view('admin.pesanan.index', [
            'pesanan' => Pesanan::get(),
        ]);
    }

    public function create()
    {
        return view('admin.pesanan.create', [
            'paket' => Paket::select('id', 'nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        return;
    }
}
