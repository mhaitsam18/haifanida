<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KantorResource extends JsonResource
{
    use FormatsStorageUrl;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_kantor' => $this->nama_kantor,
            'alamat_kantor' => $this->alamat_kantor,
            'kecamatan' => $this->kecamatan,
            'kode_pos' => $this->kode_pos,
            'jenis_kantor' => $this->jenis_kantor,
            'kontak_kantor' => $this->kontak_kantor,
            'foto_url' => $this->storageUrl($this->foto_kantor),
        ];
    }
}
