<?php

namespace App\Services\Inventory\DTO;

/**
 * Provider-neutral outcome of a booking attempt. `raw` keeps the untouched
 * provider payload for auditing/debugging without leaking its shape into
 * business logic.
 */
readonly class BookingResult
{
    public function __construct(
        public bool $success,
        public ?string $bookingReference = null, // provider confirmation number
        public ?string $status = null,           // e.g. confirmed, pending, failed
        public ?float $totalPrice = null,
        public ?string $currency = null,
        public ?string $errorMessage = null,
        public array $raw = [],
    ) {}
}
