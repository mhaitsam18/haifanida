<?php

namespace App\Services\Inventory\Contracts;

use App\Services\Inventory\DTO\BookingRequest;
use App\Services\Inventory\DTO\BookingResult;
use App\Services\Inventory\DTO\CancellationResult;
use App\Services\Inventory\DTO\HotelAvailabilityResult;
use App\Services\Inventory\DTO\HotelContent;
use App\Services\Inventory\DTO\HotelOffer;
use App\Services\Inventory\DTO\HotelSearchQuery;

/**
 * The single seam between Haifa's business logic and ANY external hotel
 * inventory provider (TBO today; RateHawk / Hotelbeds / WebBeds later).
 *
 * Everything crosses this boundary as provider-neutral DTOs, so adding or
 * swapping a provider is a new adapter class + a config line — never a change
 * to controllers, booking flows, or the domain. This is the whole point of
 * the architecture: the app depends on this interface, not on TBO.
 */
interface InventoryProvider
{
    /** Live availability + pricing for a stay. */
    public function searchAvailability(HotelSearchQuery $query): HotelAvailabilityResult;

    /** Static content for a hotel (used to enrich the local master, not pricing). */
    public function getHotelContent(string $externalHotelId): ?HotelContent;

    /** Re-price a specific rate immediately before booking (prices expire). */
    public function quote(string $rateKey): ?HotelOffer;

    /** Confirm a booking for a re-quoted rate. */
    public function book(BookingRequest $request): BookingResult;

    /** Cancel a confirmed booking by its provider reference. */
    public function cancel(string $bookingReference): CancellationResult;

    /** Stable provider identifier, e.g. 'tbo' — also used as hotel_external_id.provider. */
    public function key(): string;
}
