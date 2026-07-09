<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsDates;
use App\Http\Resources\Api\Concerns\FormatsStorageUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * A single flight leg (paket_maskapai row) merged with its airline —
 * the shape the "hover airplane" interaction needs in one payload.
 */
class PenerbanganResource extends JsonResource
{
    use FormatsDates, FormatsStorageUrl;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomor_penerbangan' => $this->nomor_penerbangan,
            'kelas' => $this->kelas,
            'bandara_asal' => $this->bandara_asal,
            'bandara_tujuan' => $this->bandara_tujuan,
            'waktu_keberangkatan' => $this->toIso8601($this->waktu_keberangkatan),
            'waktu_kedatangan' => $this->toIso8601($this->waktu_kedatangan),
            'tipe_penerbangan' => $this->tipe_penerbangan,
            'maskapai' => [
                'nama_maskapai' => $this->maskapai?->nama_maskapai,
                'kode_maskapai' => $this->maskapai?->kode_maskapai,
                'logo_url' => $this->storageUrl($this->maskapai?->logo),
            ],
        ];
    }
}
