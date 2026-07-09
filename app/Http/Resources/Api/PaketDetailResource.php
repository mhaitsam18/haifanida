<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsDates;
use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaketDetailResource extends JsonResource
{
    use FormatsDates, FormatsStorageUrl;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_paket' => $this->nama_paket,
            'destinasi' => $this->destinasi,
            'jenis_paket' => $this->jenis_paket,
            'durasi' => $this->durasi,
            'kuota_jemaah' => $this->kuota_jemaah,
            'harga' => $this->harga,
            'fasilitas' => $this->fasilitas,
            'deskripsi' => $this->deskripsi,
            'tempat_keberangkatan' => $this->tempat_keberangkatan,
            'tempat_kepulangan' => $this->tempat_kepulangan,
            'tanggal_mulai' => $this->toDateString($this->tanggal_mulai),
            'tanggal_selesai' => $this->toDateString($this->tanggal_selesai),
            'gambar_url' => $this->storageUrl($this->gambar),
            'galeri' => GaleriResource::collection($this->whenLoaded('galeris')),
            'buses' => BusResource::collection($this->whenLoaded('buses')),
            'penerbangan' => PenerbanganResource::collection($this->whenLoaded('paketMaskapais')),
            'penginapan' => PenginapanResource::collection($this->whenLoaded('paketHotels')),
        ];
    }
}
