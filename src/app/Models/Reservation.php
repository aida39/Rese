<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'shop_id',
        'course_id',
        'reservation_date',
        'reservation_time',
        'member_count',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function course()
    {
        return $this->belongsTo(course::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
