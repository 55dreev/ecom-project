<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'comment', 'parent_id'];

    public function replies()
    {
        return $this->hasMany(Review::class, 'parent_id');
    }
}
