<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Pesan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Beranda',
            'page' => 'beranda',
            'kontens' => Konten::all(),
            'beranda1' => Konten::find(1),
            'beranda2' => Konten::find(2),
            'beranda3' => Konten::find(3),
            'beranda4' => Konten::find(4),
        ]);
    }

    public function umroh()
    {
        return view('home.umroh', [
            'title' => 'Umroh',
            'page' => 'umroh',
            'kontens' => Konten::all()
        ]);
    }
    public function haji()
    {
        return view('home.haji', [
            'title' => 'Haji',
            'page' => 'haji',
            'kontens' => Konten::all()
        ]);
    }
    public function wisataHalal()
    {
        return view('home.wisata-halal', [
            'title' => 'Wisata Halal',
            'page' => 'wisata-halal',
            'kontens' => Konten::all()
        ]);
    }

    public function profil()
    {
        return view('home.profil', [
            'title' => 'Profil Perusahaan',
            'page' => 'profil',
            'kontens' => Konten::all()
        ]);
    }

    public function sejarah()
    {
        return view('home.sejarah', [
            'title' => 'Sejarah Perusahaan',
            'page' => 'sejarah',
            'kontens' => Konten::all()
        ]);
    }

    public function visiMisi()
    {
        return view('home.visi-misi', [
            'title' => 'Visi Misi',
            'page' => 'visi-misi',
            'konten' => Konten::find(6)
        ]);
    }

    public function kantorKami()
    {
        return view('home.kantor-kami', [
            'title' => 'Kantor Kami',
            'page' => 'kantor-kami',
            'kontens' => Konten::all()
        ]);
    }
    public function kirimPesan(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'nullable',
            'nama_pengirim' => 'required',
            'email_pengirim' => 'required',
            'nomor_wa_pengirim' => 'required',
            'subjek' => 'required',
            'pesan' => 'required',
        ]);
        Pesan::create($validateData);
        return back()->with('success', 'Pesan Terkirim');
    }

    public function kontakKami()
    {
        return view('home.kontak-kami', [
            'title' => 'Kontak Kami',
            'page' => 'kontak-kami',
            'kontens' => Konten::all()
        ]);
    }

    public function faq()
    {
        return view('home.faq', [
            'title' => 'FAQ',
            'page' => 'faq',
            'kontens' => Konten::all()
        ]);
    }

    public function panduan()
    {
        return view('home.panduan', [
            'title' => 'Panduan',
            'page' => 'panduan',
            'kontens' => Konten::all()
        ]);
    }
    public function syaratKetentuan()
    {
        return view('home.syarat-ketentuan', [
            'title' => 'Syarat & Ketentuan',
            'page' => 'syarat-ketentuan',
            'kontens' => Konten::all()
        ]);
    }
    public function kebijakanPrivasi()
    {
        return view('home.kebijakan-privasi', [
            'title' => 'Kebijakan Privasi',
            'page' => 'kebijakan-privasi',
            'kontens' => Konten::all()
        ]);
    }
}
