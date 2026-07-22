<?php

namespace App\Services\Inventory\Contracts;

/**
 * Opt-in capability for providers that can enumerate their hotel catalogue
 * for static-content synchronization. Kept separate from InventoryProvider
 * so a provider can offer live booking without content sync (or vice-versa).
 *
 * A provider that implements this — together with
 * InventoryProvider::getHotelContent() — can drive the full/incremental/manual
 * sync pipeline with no changes to the jobs or admin UI. TBO implements it;
 * RateHawk/Hotelbeds/WebBeds adapters can implement it later unchanged.
 */
interface SupportsContentSync
{
    /**
     * Return the provider's hotel codes for a city (e.g. "Makkah").
     * These become hotel_external_id.external_id values.
     *
     * @return string[]
     */
    public function listHotelCodes(string $city): array;
}
