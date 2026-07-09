<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'limit' => 'nullable|integer|min:1|max:50',
        ]);

        $hotels = Hotel::whereHas('pakets', function ($query) {
            $query->publish();
        })
            ->limit($validated['limit'] ?? 12)
            ->get();

        return HotelResource::collection($hotels);
    }
}
