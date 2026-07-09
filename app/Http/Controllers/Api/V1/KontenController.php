<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\KontenResource;
use App\Models\Konten;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    /**
     * The current homepage pins specific Konten rows by id (e.g. the
     * "beranda1".."beranda4" hero/about blocks) rather than a slug/type
     * column — `is_active` exists on the table but is NULL on every real
     * row and is never read by HomeController, so it can't be used as a
     * fallback filter. `ids` is required and mirrors the same hardcoded
     * pinning the Blade homepage already relies on.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|string',
        ]);

        $ids = array_filter(array_map('trim', explode(',', $validated['ids'])));

        return KontenResource::collection(Konten::whereIn('id', $ids)->get());
    }
}
