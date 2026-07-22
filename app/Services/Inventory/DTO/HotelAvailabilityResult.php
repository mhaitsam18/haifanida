<?php

namespace App\Services\Inventory\DTO;

/**
 * The normalized result of an availability search: a list of HotelOffer plus
 * light metadata. Keeps controllers from ever touching a provider's paging
 * or envelope shape.
 */
readonly class HotelAvailabilityResult
{
    /**
     * @param  HotelOffer[]  $offers
     */
    public function __construct(
        public array $offers = [],
        public ?string $searchId = null,   // provider session/trace id if any
        public array $raw = [],
    ) {}

    public function isEmpty(): bool
    {
        return $this->offers === [];
    }
}
