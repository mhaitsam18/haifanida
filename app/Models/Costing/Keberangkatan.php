<?php

namespace App\Models\Costing;

use App\Models\Paket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A departure — the costed/sold/settled unit. procurement_mode decides whether
 * the ticket-risk model applies.
 */
class Keberangkatan extends Model
{
    protected $table = 'keberangkatan';
    protected $guarded = ['id'];

    protected $casts = [
        'departure_date' => 'date',
        'arrival_at' => 'datetime',
        'return_at' => 'datetime',
        'materialisation_pct' => 'decimal:4',
        'channel_mix_agent_pct' => 'decimal:4',
        'publish_price' => 'decimal:2',
        'tl_opt_in' => 'boolean',
        'transit_villa' => 'boolean',
        'handling_bundled_la' => 'boolean',
        'mutawwif_free' => 'boolean',
    ];

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function tier(): BelongsTo
    {
        return $this->belongsTo(PackageTier::class, 'package_tier_id');
    }

    public function ticketLots(): HasMany
    {
        return $this->hasMany(TicketLot::class, 'keberangkatan_id');
    }

    public function costings(): HasMany
    {
        return $this->hasMany(Costing::class, 'keberangkatan_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isOnDemand(): bool
    {
        return $this->procurement_mode === 'on_demand';
    }
}
