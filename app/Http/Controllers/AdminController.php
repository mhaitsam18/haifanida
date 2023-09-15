<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'jmlPesanan' => Pesanan::count(),
            'jmlTestimoni' => Testimoni::count(),
            'pesananTerakhir' => Pesanan::limit(10)->orderBy('id', 'DESC')->get(),
            'testimoniTerakhir' => Testimoni::limit(10)->orderBy('id', 'DESC')->get(),
        ]);
    }
}
