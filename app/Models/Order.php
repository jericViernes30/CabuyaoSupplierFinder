<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rice_id',
        'order_type',
        'count',
        'status'
    ];

    public function retailer()
    {
        return $this->belongsTo(Retailer::class, 'user_id', 'id');
    }

    public function rice()
    {
        return $this->belongsTo(Rice::class, 'rice_id', 'id');
    }
}


