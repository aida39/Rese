<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopGenre extends Model
{
    use HasFactory;
    protected $fillable = ['shop_genre'];

    public function shop()
    {
        return $this->hasMany(Shop::class);
    }
}
