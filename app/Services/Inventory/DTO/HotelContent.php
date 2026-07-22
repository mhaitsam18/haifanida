<?php

namespace App\Services\Inventory\DTO;

/**
 * Provider-neutral static hotel content used by HotelSyncService to enrich
 * the local curated master (never pricing — that stays live/rented). Fields
 * are nullable: an adapter maps only what its provider actually returns and
 * leaves the rest null, matching the "NULL over guessing" master-data rule.
 */
readonly class HotelContent
{
    public function __construct(
        public string $externalHotelId,
        public string $name,
        public ?string $city = null,
        public ?string $address = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?int $starRating = null,
        public ?string $website = null,
        public ?string $phone = null,
        public ?string $email = null,
        /** @var string[] */
        public array $facilities = [],
        /** @var string[] */
        public array $imageUrls = [],
        public ?string $description = null,
        /** Provider's own last-modified timestamp for this content, if exposed. */
        public ?string $providerUpdatedAt = null,
    ) {}
}
