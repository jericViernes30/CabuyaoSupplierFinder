<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'dealer_id',
        'retailer',
        'rice_name',
        'quantity',
        'total_amount',
        'order_type'
    ];
}
