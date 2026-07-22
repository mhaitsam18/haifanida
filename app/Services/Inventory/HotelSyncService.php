<?php

namespace App\Services\Inventory;

use App\Models\Hotel;
use App\Services\Inventory\Contracts\SupportsContentSync;
use App\Services\Inventory\DTO\HotelContent;

/**
 * Reconciles a provider's static hotel content into Haifa's curated master
 * via the hotel_external_id seam — provider-agnostic (works for any
 * InventoryProvider). It only ever writes slow-changing master data and
 * NEVER pricing/availability. It also never overwrites a value Haifa has
 * curated by hand: it fills gaps (null → provider value) but leaves existing
 * curated fields intact, so the local record stays the source of truth.
 *
 * No provider is wired yet; this is the destination that a future adapter's
 * getHotelContent() output flows into.
 */
class HotelSyncService
{
    /**
     * Link (or create) the local hotel that corresponds to a provider hotel,
     * then gap-fill master fields. Returns the local Hotel.
     */
    public function syncContent(SupportsContentSync $provider, HotelContent $content): Hotel
    {
        // 1. Find the local hotel already mapped to this provider code, if any.
        $hotel = Hotel::whereHas('externalIds', fn ($q) => $q
            ->where('provider', $provider->key())
            ->where('external_id', $content->externalHotelId)
        )->first();

        // 2. Otherwise create a thin master record to attach the mapping to.
        $hotel ??= Hotel::create([
            'nama_hotel' => $content->name,
            'kota' => $content->city,
            'aktif' => true,
        ]);

        // 3. Gap-fill only: never clobber values Haifa curated by hand.
        $fill = array_filter([
            'alamat' => $content->address,
            'latitude' => $content->latitude,
            'longitude' => $content->longitude,
            'bintang' => $content->starRating,
            'website' => $content->website,
            'telepon' => $content->phone,
            'email' => $content->email,
            'deskripsi' => $content->description,
        ], fn ($v) => $v !== null);

        foreach ($fill as $column => $value) {
            if (blank($hotel->{$column})) {
                $hotel->{$column} = $value;
            }
        }
        $hotel->save();

        // 4. Idempotently record the external mapping.
        $hotel->externalIds()->updateOrCreate(
            ['provider' => $provider->key(), 'external_id' => $content->externalHotelId],
            ['meta' => null]
        );

        return $hotel;
    }
}
