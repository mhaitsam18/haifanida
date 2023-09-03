<?php

namespace App\Http\Controllers;

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
    }
}
