<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'image_url', 'description', 'price', 'category', 'fav_id', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
