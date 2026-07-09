<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TestimoniResource;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'limit' => 'nullable|integer|min:1|max:50',
        ]);

        $testimonis = Testimoni::where('disetujui', true)
            ->whereNotNull('isi_testimoni')
            ->with('jemaah')
            ->latest()
            ->limit($validated['limit'] ?? 12)
            ->get();

        return TestimoniResource::collection($testimonis);
    }
}
