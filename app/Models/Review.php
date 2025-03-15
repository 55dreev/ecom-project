<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['costume_id', 'name', 'comment', 'parent_id', 'rating'];

    // Relationship: A review belongs to a costume
    public function costume()
    {
        return $this->belongsTo(Costume::class);
    }
    public function replies()
    {
        return $this->hasMany(Review::class, 'parent_id')->orderBy('created_at', 'asc');
    }
}
