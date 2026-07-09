<?php

namespace App\Http\Resources\Api\Concerns;

use Illuminate\Support\Carbon;

trait FormatsDates
{
    /**
     * Paket/PaketMaskapai/PaketHotel declare date columns via the legacy
     * $dates property, which this Laravel version no longer honors
     * (getDates() only auto-casts created_at/updated_at) — so these
     * columns arrive as plain strings, not Carbon instances. Parsed
     * defensively here rather than adding $casts to the shared models.
     */
    protected function toDateString(?string $value): ?string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    protected function toIso8601(?string $value): ?string
    {
        return $value ? Carbon::parse($value)->toIso8601String() : null;
    }
}
