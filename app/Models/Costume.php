<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costume extends Model
{
    public function reviews()
{
    return $this->hasMany(Review::class, 'costume_id');
}

}
