<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Effective-dated snapshot of what the Umrah visa bundle covers. Resolved by a
 * costing's departure date so historical costings reproduce historical rules.
 */
class VisaCoverageRuleset extends Model
{
    protected $table = 'visa_coverage_ruleset';
    protected $guarded = ['id'];

    protected $casts = [
        'provides_tags' => 'array',
        'effective_from' => 'date',
    ];

    /** The ruleset in force on $date (newest effective_from on or before it). */
    public static function forDate(Carbon|string $date): ?self
    {
        $day = ($date instanceof Carbon ? $date : Carbon::parse($date))->toDateString();

        return static::whereDate('effective_from', '<=', $day)
            ->orderByDesc('effective_from')
            ->orderByDesc('id')
            ->first();
    }
}
