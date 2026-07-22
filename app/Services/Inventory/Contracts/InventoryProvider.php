<?php

namespace App\Services\Inventory\Contracts;

/**
 * Base identity for any external hotel provider. Concrete capabilities are
 * declared by the sub-interfaces so the STATIC and DYNAMIC sides of a
 * provider are cleanly separated:
 *
 *   - SupportsContentSync   → static content (name, chain, coords, facilities,
 *                             gallery, nearby, description) that feeds the
 *                             curated local master. Slow-changing.
 *   - SupportsLiveInventory → dynamic inventory (availability, rates, pre-book,
 *                             book, cancel) queried in REAL TIME and never
 *                             persisted (except deliberate short-lived caching).
 *
 * A provider may implement one or both. Business code depends on the
 * capability it needs — not on any concrete provider — so TBO, RateHawk,
 * Hotelbeds, WebBeds, Expedia… are added as adapters with zero changes to
 * controllers, jobs, or the domain.
 */
interface InventoryProvider
{
    /** Stable provider identifier, e.g. 'tbo' — also hotel_external_id.provider. */
    public function key(): string;
}
