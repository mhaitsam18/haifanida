<?php

namespace App\Http\Controllers;

use App\Models\Album;

class HomeGaleriController extends Controller
{
    /**
     * Album-based public gallery: the index shows album cards so jema'ah can
     * find their departure group's memories; an album opens to its photos.
     */
    public function index()
    {
        return view('home.galeri.index', [
            'title' => 'Galeri',
            'page' => 'galeri',
            'albums' => Album::withCount('galeris')
                ->having('galeris_count', '>', 0)
                ->orderByRaw('tanggal IS NULL, tanggal DESC')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    public function show(Album $album)
    {
        return view('home.galeri.show', [
            'title' => $album->judul,
            'page' => 'galeri',
            'album' => $album,
            'galeries' => $album->galeris()->orderBy('id')->get(),
        ]);
    }
}
