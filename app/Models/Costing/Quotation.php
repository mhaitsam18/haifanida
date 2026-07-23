<?php

namespace App\Models\Costing;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Quotation extends Model
{
    protected $table = 'quotation';
    protected $guarded = ['id'];

    protected $casts = [
        'config_json' => 'array',
        'quoted_price' => 'decimal:2',
        'quoted_margin' => 'decimal:2',
        'valid_until' => 'date',
    ];

    public function costing(): BelongsTo
    {
        return $this->belongsTo(Costing::class, 'costing_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isExpired(): bool
    {
        return $this->valid_until !== null && $this->valid_until->isBefore(Carbon::today());
    }
}
