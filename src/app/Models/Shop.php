<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_area_id',
        'shop_genre_id',
        'shop_name',
        'shop_description',
    ];

    public function shopArea()
    {
        return $this->belongsTo(ShopArea::class);
    }

    public function shopGenre()
    {
        return $this->belongsTo(ShopGenre::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
    
    public function scopeAreaSearch($query, $shop_area_id)
    {
        if (!empty($shop_area_id)) {
            $query->where('shop_area_id', $shop_area_id);
        }
    }

    public function scopeGenreSearch($query, $shop_genre_id)
    {
        if (!empty($shop_genre_id)) {
            $query->where('shop_genre_id', $shop_genre_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('shop_name', 'like', '%' . $keyword . '%');
        }
    }
}
