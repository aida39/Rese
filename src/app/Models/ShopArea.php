<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopArea extends Model
{
    use HasFactory;
    protected $fillable = ['shop_area'];

    public function shop()
    {
        return $this->hasMany(Shop::class);
    }
}
