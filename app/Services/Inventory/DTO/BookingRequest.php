<?php

namespace App\Services\Inventory\DTO;

/**
 * Provider-neutral booking instruction. `rateKey` comes from a prior
 * HotelOffer (ideally re-quoted first via InventoryProvider::quote()).
 */
readonly class BookingRequest
{
    /**
     * @param  array<int, array{title?:string, firstName:string, lastName:string, isLead?:bool}>  $guests
     */
    public function __construct(
        public string $rateKey,
        public array $guests,
        public string $contactEmail,
        public string $contactPhone,
        public ?string $clientReference = null, // Haifa's own booking id
        public ?string $specialRequest = null,
    ) {}
}
