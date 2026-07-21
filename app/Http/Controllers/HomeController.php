<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\FiltersPaketListing;
use App\Models\Konten;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    use FiltersPaketListing;

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
        // Legacy method; the live /umroh route uses UmrohController@index.
        return redirect('/umroh');
    }
    public function haji(Request $request)
    {
        return view('home.paket.listing', [
            'title' => 'Paket Haji',
            'page' => 'haji',
            'jenis' => 'haji',
            'action' => '/haji',
            'subtitle' => 'Tunaikan rukun Islam kelima bersama pendamping berpengalaman dan pelayanan terbaik dari Haifa Nida Wisata.',
            ...$this->paketListing($request, 'haji'),
        ]);
    }
    public function wisataHalal(Request $request)
    {
        return view('home.paket.listing', [
            'title' => 'Wisata Halal',
            'page' => 'wisata-halal',
            'jenis' => 'wisata halal',
            'action' => '/wisata-halal',
            'subtitle' => 'Jelajahi destinasi dunia dengan kenyamanan dan kepastian halal di setiap langkah perjalanan.',
            ...$this->paketListing($request, 'wisata halal'),
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
        $faqGroups = \App\Models\Faq::active()
            ->orderBy('urutan')
            ->get()
            ->groupBy(fn ($faq) => $faq->kategori ?: 'Umum');

        return view('home.faq', [
            'title' => 'FAQ',
            'page' => 'faq',
            'faqGroups' => $faqGroups,
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
