<?php

namespace App\Services\Inventory\Contracts;

use App\Services\Inventory\DTO\BookingRequest;
use App\Services\Inventory\DTO\BookingResult;
use App\Services\Inventory\DTO\CancellationResult;
use App\Services\Inventory\DTO\HotelAvailabilityResult;
use App\Services\Inventory\DTO\HotelOffer;
use App\Services\Inventory\DTO\HotelSearchQuery;

/**
 * DYNAMIC-inventory capability. Availability, rates, pre-book, book and
 * cancel — always fetched in REAL TIME from the provider and returned as
 * transient DTOs. None of it is persisted to the local database (a thin,
 * short-TTL cache decorator over this interface is the only sanctioned place
 * dynamic data may be held, and even then only briefly).
 *
 * Every result crosses the boundary as a provider-neutral DTO, so the
 * booking flow never sees a provider's raw payload.
 */
interface SupportsLiveInventory extends InventoryProvider
{
    /** Live availability + pricing for a stay. */
    public function searchAvailability(HotelSearchQuery $query): HotelAvailabilityResult;

    /** Re-price a specific rate immediately before booking (prices expire). */
    public function quote(string $rateKey): ?HotelOffer;

    /** Confirm a booking for a re-quoted rate. */
    public function book(BookingRequest $request): BookingResult;

    /** Cancel a confirmed booking by its provider reference. */
    public function cancel(string $bookingReference): CancellationResult;
}
