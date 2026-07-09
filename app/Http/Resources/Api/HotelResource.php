<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    use FormatsStorageUrl;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_hotel' => $this->nama_hotel,
            'bintang' => $this->bintang === null ? null : (int) $this->bintang,
            'bintang_setaraf' => $this->bintang_setaraf,
            'kota' => $this->kota,
            'negara' => $this->negara,
            'alamat' => $this->alamat,
            'link_gmaps' => $this->link_gmaps,
            'deskripsi' => $this->deskripsi,
            'gambar_url' => $this->storageUrl($this->gambar),
        ];
    }
}
