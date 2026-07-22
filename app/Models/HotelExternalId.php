<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelExternalId extends Model
{
    use HasFactory;

    protected $table = 'hotel_external_id';
    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'array',
        'last_synced_at' => 'datetime',
        'provider_updated_at' => 'datetime',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function scopeForProvider($query, string $provider)
    {
        return $query->where('provider', $provider);
    }

    public function scopeFailed($query)
    {
        return $query->where('sync_status', 'failed');
    }

    /** Rows never synced, or last synced before the given cutoff (incremental). */
    public function scopeStale($query, \DateTimeInterface $before)
    {
        return $query->where(fn ($q) => $q
            ->whereNull('last_synced_at')
            ->orWhere('last_synced_at', '<', $before));
    }
}
