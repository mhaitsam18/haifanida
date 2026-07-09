<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PaketDetailResource;
use App\Http\Resources\Api\PaketResource;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'jenis_paket' => 'nullable|in:umroh,haji,wisata halal',
            'upcoming' => 'nullable|boolean',
            'limit' => 'nullable|integer|min:1|max:50',
        ]);

        $query = Paket::publish();

        if (! empty($validated['jenis_paket'])) {
            $query->where('jenis_paket', $validated['jenis_paket']);
        }

        if ($request->boolean('upcoming')) {
            $query->whereDate('tanggal_mulai', '>=', now()->toDateString())
                ->orderBy('tanggal_mulai', 'asc');
        } else {
            $query->orderBy('tanggal_mulai', 'desc');
        }

        $pakets = $query->limit($validated['limit'] ?? 12)->get();

        return PaketResource::collection($pakets);
    }

    public function show(Paket $paket)
    {
        abort_unless($paket->published_at !== null, 404);

        $paket->load(['galeris', 'buses', 'paketMaskapais.maskapai', 'paketHotels.hotel']);

        return new PaketDetailResource($paket);
    }
}
