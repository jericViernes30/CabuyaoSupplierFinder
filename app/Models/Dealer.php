<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dealer extends Authenticatable
{
    use Notifiable;
    protected $table = 'dealers';

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'contact_number',
        'address',
        'latitude',
        'longitude',
        'business_name',
        'business_type',
        'password'
    ];
}
