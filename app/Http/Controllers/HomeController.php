<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('landing-page.index', [
            'testimoni' => Testimoni::all(),
            'faq' => Faq::all()
        ]);
    }
}
