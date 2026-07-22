<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artikel;
use App\Models\Paket;

class SitemapController extends Controller
{
    /**
     * Generates the XML sitemap from the static public routes plus live
     * published content (packages, albums, articles). Cached lightly at the
     * HTTP layer via the response headers.
     */
    public function index()
    {
        $urls = [];

        // Static public pages with relative priority/change frequency.
        $static = [
            ['/', '1.0', 'weekly'],
            ['/umroh', '0.9', 'daily'],
            ['/haji', '0.8', 'weekly'],
            ['/wisata-halal', '0.8', 'weekly'],
            ['/galeri', '0.7', 'weekly'],
            ['/artikel', '0.7', 'weekly'],
            ['/profil', '0.6', 'monthly'],
            ['/sejarah', '0.5', 'monthly'],
            ['/visi-misi', '0.5', 'monthly'],
            ['/kantor-kami', '0.5', 'monthly'],
            ['/kontak-kami', '0.6', 'monthly'],
            ['/faq', '0.6', 'monthly'],
            ['/panduan', '0.5', 'monthly'],
            ['/syarat-ketentuan', '0.3', 'yearly'],
            ['/kebijakan-privasi', '0.3', 'yearly'],
        ];
        foreach ($static as [$path, $priority, $freq]) {
            $urls[] = ['loc' => url($path), 'priority' => $priority, 'changefreq' => $freq, 'lastmod' => null];
        }

        foreach (Paket::whereNotNull('published_at')->get() as $paket) {
            $urls[] = ['loc' => url('/paket/' . $paket->id), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $paket->updated_at?->toAtomString()];
        }

        foreach (Album::has('galeris')->get() as $album) {
            $urls[] = ['loc' => url('/galeri/' . $album->id), 'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => $album->updated_at?->toAtomString()];
        }

        if (class_exists(Artikel::class)) {
            foreach (Artikel::where('published', true)->get() as $artikel) {
                $urls[] = ['loc' => url('/artikel/' . $artikel->slug), 'priority' => '0.6', 'changefreq' => 'monthly', 'lastmod' => $artikel->updated_at?->toAtomString()];
            }
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
