<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Paket;
use Illuminate\Http\Request;

/**
 * Shared listing/filter pipeline for the public package pages
 * (/umroh, /haji, /wisata-halal) so all three stay identical in behavior.
 */
trait FiltersPaketListing
{
    protected function paketListing(Request $request, string $jenis): array
    {
        $query = Paket::where('jenis_paket', $jenis)->whereNotNull('published_at');

        // Price inputs arrive formatted with Indonesian thousand separators
        // ("1.000.000") — compare on digits only, otherwise MySQL casts the
        // dotted string to 1.0 and the filter silently matches everything.
        $hargaMin = $this->digitsOrNull($request->input('harga_min'));
        $hargaMax = $this->digitsOrNull($request->input('harga_max'));

        if ($hargaMin !== null) {
            $query->where('harga', '>=', $hargaMin);
        }
        if ($hargaMax !== null) {
            $query->where('harga', '<=', $hargaMax);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal_mulai', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->where('tanggal_mulai', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('durasi')) {
            $query->where('durasi', $request->durasi);
        }

        match ($request->input('urutkan')) {
            'harga_terendah' => $query->orderBy('harga', 'asc'),
            'harga_tertinggi' => $query->orderBy('harga', 'desc'),
            'durasi_terpendek' => $query->orderBy('durasi', 'asc'),
            'durasi_terpanjang' => $query->orderBy('durasi', 'desc'),
            default => $query->latest(),
        };

        $durasiOptions = Paket::where('jenis_paket', $jenis)
            ->whereNotNull('published_at')
            ->distinct()
            ->pluck('durasi')
            ->sort()
            ->values()
            ->toArray();

        return [
            'pakets' => $query->get(),
            'durasiOptions' => $durasiOptions,
            'filters' => $request->all(),
        ];
    }

    private function digitsOrNull($value): ?int
    {
        $digits = preg_replace('/\D/', '', (string) $value);

        return $digits === '' ? null : (int) $digits;
    }
}
