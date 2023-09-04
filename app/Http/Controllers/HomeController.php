<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Kontak;
use App\Models\Paket;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('landing-page.index', [
            'testimoni' => Testimoni::where('shown', 1)->get(),
            'faq' => Faq::all(),
            'paket' => Paket::take(8)->get(),
        ]);
    }

    public function kontak() {
        return view('landing-page.kontak', [
            'kontak' => Kontak::all(),
        ]);
    }
}
