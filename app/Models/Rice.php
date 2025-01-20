<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'per_sack',
        'per_kg',
        'price_bought',
        'address',
        'quality',
        'dealer',
        'image_name'
    ];

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);  // Assuming the foreign key is dealer_id in rice table
    }
}
