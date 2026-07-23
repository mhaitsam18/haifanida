<?php

namespace App\Models\Costing;

use App\Models\Paket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * An immutable costing snapshot. Once frozen it must never change; later
 * rate/FX/rule changes can't retroactively move a sold package's margin.
 */
class Costing extends Model
{
    protected $table = 'costing';
    protected $guarded = ['id'];

    protected $casts = [
        'inputs_json' => 'array',
        'warnings_json' => 'array',
        'materialisation_applicable' => 'boolean',
        'published_at' => 'datetime',
        'frozen_at' => 'datetime',
    ];

    public function keberangkatan(): BelongsTo
    {
        return $this->belongsTo(Keberangkatan::class, 'keberangkatan_id');
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(CostingLine::class, 'costing_id');
    }

    public function publishedPrices(): HasMany
    {
        return $this->hasMany(CostingPublishedPrice::class, 'costing_id');
    }

    public function ancillaries(): HasMany
    {
        return $this->hasMany(CostingAncillary::class, 'costing_id');
    }

    public function fxVersion(): BelongsTo
    {
        return $this->belongsTo(FxPolicyVersion::class, 'fx_policy_version_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isFrozen(): bool
    {
        return $this->status === 'frozen';
    }
}
