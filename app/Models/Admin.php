<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // protected $guard = 'admin'; // Explicitly set the guard

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birth_date',
        'gender',
    ];

    protected $casts = [
    'birth_date' => 'date',
    ];
}
