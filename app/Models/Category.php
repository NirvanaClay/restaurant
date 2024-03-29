<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'image_url', 'items', 'description'];
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
