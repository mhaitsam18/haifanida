<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// MODIFIED--
use App\Models\Pemesanan;
use App\Models\Pembayaran;
// --MODIFIED

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
        // MODIFIED--
        $title = 'Profile | Haifa Nida Wisata';
        return view('home.profile', compact('user', 'mode', 'title'));
        // --MODIFIED
    }

    // MODIFIED--
    // fungsi untuk view perjalanan saya
    public function perjalananSaya(Request $request){
        $user = Auth::user();
        $title = 'Perjalanan Saya | Haifa Nida Wisata';
        return view('home.perjalanan-saya', compact('user', 'title'));
    }
    // --MODIFIED

    // MODIFIED--
    public function tagihan(Request $request){
        $user = Auth::user();
        $title = 'Tagihan | Haifa Nida Wisata';

        $tagihan = $user->pemesanans()->with('pembayarans.pemesanan.paket')->get()->flatMap->pembayarans;

        return view('home.tagihan', compact('user', 'title', 'tagihan'));
    }
    // --MODIFIED
}
