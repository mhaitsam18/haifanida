<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemesananStatusHistory extends Model
{
    protected $table = 'pemesanan_status_history';
    protected $guarded = [
        'id'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
