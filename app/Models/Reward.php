<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    public $timestamps = false;
    public $fillable = ['code', 'amount', 'user_id'];
    protected $attributes = [
        'amount' => 5
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
