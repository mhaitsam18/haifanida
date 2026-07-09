<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsDates;
use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaketResource extends JsonResource
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
            'tanggal_mulai' => $this->toDateString($this->tanggal_mulai),
            'tanggal_selesai' => $this->toDateString($this->tanggal_selesai),
            'tempat_keberangkatan' => $this->tempat_keberangkatan,
            'tempat_kepulangan' => $this->tempat_kepulangan,
            'gambar_url' => $this->storageUrl($this->gambar),
        ];
    }
}
