<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['id', 'name', 'cpf', 'email', 'birth_date', 'main_phone', 'reference_contact_name', 'reference_contact', 'is_active', 'created_at', 'updated_at'];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
