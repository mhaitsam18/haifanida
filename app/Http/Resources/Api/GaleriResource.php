<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GaleriResource extends JsonResource
{
    use FormatsStorageUrl;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'jenis' => $this->jenis,
            'file_url' => $this->storageUrl($this->file_path),
        ];
    }
}
