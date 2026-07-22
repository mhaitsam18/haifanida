<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSyncRun extends Model
{
    use HasFactory;

    protected $table = 'hotel_sync_run';
    protected $guarded = ['id'];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function progressPercent(): int
    {
        if ($this->total_hotels <= 0) {
            return $this->status === 'completed' ? 100 : 0;
        }

        return (int) floor((($this->processed_hotels + $this->failed_hotels) / $this->total_hotels) * 100);
    }

    public function isRunning(): bool
    {
        return in_array($this->status, ['queued', 'running'], true);
    }
}
