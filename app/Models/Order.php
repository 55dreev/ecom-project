<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items',           // Store cart items as JSON
        'grand_total',
        'status',          // pending, paid, failed
    ];

    // Optional: Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
