<?php

namespace App\Services\Inventory\DTO;

/**
 * A provider-neutral availability request. Business code builds this; each
 * adapter translates it into its provider's specific request shape.
 */
readonly class HotelSearchQuery
{
    /**
     * @param  array<int, array{adults:int, children?:int}>  $rooms  occupancy per room
     * @param  string[]  $externalHotelIds  restrict to specific provider hotel codes (optional)
     */
    public function __construct(
        public string $city,
        public string $checkIn,   // Y-m-d
        public string $checkOut,  // Y-m-d
        public array $rooms,
        public string $nationality = 'ID',
        public string $currency = 'IDR',
        public array $externalHotelIds = [],
    ) {}
}
