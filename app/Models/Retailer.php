<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'contact_number',
        'address',
        'business_name',
        'business_type',
        'lat',
        'long',
        'password'
    ];

}
