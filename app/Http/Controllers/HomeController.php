<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private function allKontens()
    {
        return Cache::remember('konten.all', now()->addHours(6), fn () => Konten::all());
    }

    public function index()
    {
        return view('home.index', [
            'title' => 'Beranda',
            'page' => 'beranda',
            'kontens' => $this->allKontens(),
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
            'kontens' => $this->allKontens()
        ]);
    }
    public function haji()
    {
        return view('home.haji', [
            'title' => 'Haji',
            'page' => 'haji',
            'kontens' => $this->allKontens()
        ]);
    }
    public function wisataHalal()
    {
        return view('home.wisata-halal', [
            'title' => 'Wisata Halal',
            'page' => 'wisata-halal',
            'kontens' => $this->allKontens()
        ]);
    }

    public function profil()
    {
        return view('home.profil', [
            'title' => 'Profil Perusahaan',
            'page' => 'profil',
            'kontens' => $this->allKontens()
        ]);
    }

    public function sejarah()
    {
        return view('home.sejarah', [
            'title' => 'Sejarah Perusahaan',
            'page' => 'sejarah',
            'kontens' => $this->allKontens()
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
            'kontens' => $this->allKontens()
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
            'kontens' => $this->allKontens()
        ]);
    }

    public function faq()
    {
        return view('home.faq', [
            'title' => 'FAQ',
            'page' => 'faq',
            'kontens' => $this->allKontens()
        ]);
    }

    public function panduan()
    {
        return view('home.panduan', [
            'title' => 'Panduan',
            'page' => 'panduan',
            'kontens' => $this->allKontens()
        ]);
    }
    public function syaratKetentuan()
    {
        return view('home.syarat-ketentuan', [
            'title' => 'Syarat & Ketentuan',
            'page' => 'syarat-ketentuan',
            'kontens' => $this->allKontens()
        ]);
    }
    public function kebijakanPrivasi()
    {
        return view('home.kebijakan-privasi', [
            'title' => 'Kebijakan Privasi',
            'page' => 'kebijakan-privasi',
            'kontens' => $this->allKontens()
        ]);
    }

    public function keluhan()
    {
        return view('home.keluhan', [
            'title' => "Form Pengaduan & Keluhan Jema'ah",
            'page' => 'keluhan'
        ]);
    }
    public function kuesioner()
    {
        return view('home.kuesioner', [
            'title' => "Form Kuesioner Kepuasan Jema'ah",
            'page' => 'kuesioner'
        ]);
    }
}
