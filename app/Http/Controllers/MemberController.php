<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Beranda | Haifa Nida Wisata',
            'page' => 'beranda',
        ]);
    }
}
