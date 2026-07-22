<?php

namespace App\Services\Inventory\Contracts;

use App\Services\Inventory\DTO\HotelContent;

/**
 * STATIC-content capability. A provider that can enumerate its hotel
 * catalogue and return per-hotel descriptive content for synchronization
 * into Haifa's curated master. This is the ONLY provider path that writes to
 * the local database — and it writes slow-changing content only, never
 * pricing/availability.
 *
 * Implementing this (nothing else) is enough to drive the full/incremental/
 * manual sync pipeline — jobs and admin UI are unchanged per provider.
 */
interface SupportsContentSync extends InventoryProvider
{
    /**
     * The provider's hotel codes for a city (e.g. "Makkah"). These become
     * hotel_external_id.external_id values.
     *
     * @return string[]
     */
    public function listHotelCodes(string $city): array;

    /** Static descriptive content for one hotel (never pricing). */
    public function getHotelContent(string $externalHotelId): ?HotelContent;
}
