<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KontenResource extends JsonResource
{
    use FormatsStorageUrl;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'judul' => $this->judul,
            'isi_konten' => $this->isi_konten,
            'gambar_url' => $this->storageUrl($this->gambar),
        ];
    }
}
