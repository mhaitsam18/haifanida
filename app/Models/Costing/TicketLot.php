<?php

namespace App\Models\Costing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketLot extends Model
{
    protected $table = 'ticket_lot';
    protected $guarded = ['id'];

    protected $casts = [
        'seats' => 'integer',
        'unit_price' => 'decimal:2',
        'deposit_pct' => 'decimal:2',
        'deposit_flat' => 'decimal:2',
        'deposit_token' => 'decimal:2',
        'deposit_is_layered' => 'boolean',
        'contingent_liability_on_cancel' => 'boolean',
    ];

    public function keberangkatan(): BelongsTo
    {
        return $this->belongsTo(Keberangkatan::class, 'keberangkatan_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /** Committed deposit for this lot in its own currency (before FX). */
    public function depositAmount(): float
    {
        return match ($this->deposit_type) {
            'percentage' => $this->seats * (float) $this->unit_price * ((float) $this->deposit_pct / 100),
            'flat' => $this->seats * (float) $this->deposit_flat,
            default => 0.0,
        };
    }
}
