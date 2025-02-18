<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserEcom extends Authenticatable {
    use HasFactory;

    protected $table = 'users_ecom';

    protected $fillable = [
        'username',
        'email',
        'dob',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}

