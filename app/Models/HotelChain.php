<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelChain extends Model
{
    use HasFactory;

    protected $table = 'hotel_chain';
    protected $guarded = ['id'];

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'hotel_chain_id');
    }
}
