<?php

namespace App\Services\Inventory\DTO;

/**
 * One bookable rate for one hotel, normalized across providers. `rateKey` is
 * the opaque token the provider needs to quote/book this exact rate; business
 * code treats it as a black box.
 */
readonly class HotelOffer
{
    public function __construct(
        public string $externalHotelId,
        public string $hotelName,
        public string $rateKey,
        public float $totalPrice,
        public string $currency,
        public ?string $board = null,          // e.g. RO, BB, HB
        public ?string $roomType = null,
        public bool $refundable = false,
        public ?string $cancellationPolicy = null,
    ) {}
}
