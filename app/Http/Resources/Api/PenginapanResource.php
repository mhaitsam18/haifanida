<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Concerns\FormatsDates;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * A paket_hotel row (a package's stay at a hotel) merged with the hotel
 * itself — the shape the "hover hotel" interaction needs in one payload.
 */
class PenginapanResource extends JsonResource
{
    use FormatsDates;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tanggal_check_in' => $this->toDateString($this->tanggal_check_in),
            'tanggal_check_out' => $this->toDateString($this->tanggal_check_out),
            'jumlah_kamar' => $this->jumlah_kamar,
            'hotel' => $this->hotel ? new HotelResource($this->hotel) : null,
        ];
    }
}
