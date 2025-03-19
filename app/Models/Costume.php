<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costume extends Model
{
    public function reviews()
{
    return $this->hasMany(Review::class, 'costume_id');
}

    use HasFactory;

    protected $table = 'costumes';  // Reference your existing table

    protected $fillable = [
        'name', 
        'price', 
        'image', 
        'description', 
        'created_at', 
        'updated_at'
    ];
    public $timestamps = true;
}
