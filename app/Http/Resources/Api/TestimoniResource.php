<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimoniResource extends JsonResource
{
    use FormatsStorageUrl;

    /**
     * Jemaah records hold sensitive personal data (KTP, passport, address,
     * etc.) — only the display name and photo are safe to expose here.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'isi_testimoni' => $this->isi_testimoni,
            'rating' => $this->rating,
            'nama' => $this->jemaah?->nama_lengkap,
            'foto_url' => $this->storageUrl($this->jemaah?->foto),
        ];
    }
}
