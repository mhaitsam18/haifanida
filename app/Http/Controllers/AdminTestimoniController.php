<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminTestimoniController extends Controller
{
    public function index()
    {
        return view('admin.testimoni.index', [
            'testimoni' => Testimoni::get(),
        ]);
    }
}
