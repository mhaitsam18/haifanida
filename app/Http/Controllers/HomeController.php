<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('landing-page.index');
    }
}
