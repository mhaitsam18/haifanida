<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

    public function profile(Request $request){
        $user = Auth::user();
        $mode = $request->query('mode', 'show');
        return view('home.profile', compact('user', 'mode'));
    }
}
