<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'image_url', 'description', 'price', 'quantity'];
}
