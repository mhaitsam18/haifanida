<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomor_rombongan' => $this->nomor_rombongan,
            'merek' => $this->merek,
            'kapasitas' => $this->kapasitas,
            'fasilitas' => $this->fasilitas,
        ];
    }
}
