<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'dealer_id', // I just named it dealer_id but the actual value is the business_name
        'retailer',
        'rice_name',
        'quantity',
        'total_amount',
        'order_type',
        'rated'
    ];
}
