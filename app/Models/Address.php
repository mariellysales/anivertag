<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = ['id', 'postal_code', 'street', 'number', 'additional_information', 'neighborhood', 'city', 'state', 'country', 'user_id', 'created_at', 'updated_at'];
}
