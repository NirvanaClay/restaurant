<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'image_url', 'category_id', 'description', 'price', 'quantity'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
