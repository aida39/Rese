<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Course;
use Carbon\Carbon;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $today = Carbon::now()->format('Y-m-d');

        $future_reservations = Reservation::where('user_id', $user->id)
            ->whereDate('reservation_date', '>=', $today)->with('shop')->get();
        foreach ($future_reservations as $future_reservation) {
            $future_reservation->formatted_time = Carbon::parse($future_reservation->reservation_time)->format('H:i');
        }

        $visited_records = Reservation::where('user_id', $user->id)->where('visited_flag', 1)->with('shop')->get();
        foreach ($visited_records as $visited_record) {
            $visited_record->formatted_time = Carbon::parse($visited_record->reservation_time)->format('H:i');
            $visited_record->is_reviewed = $visited_record->review()->exists();
        }

        $favorites = Favorite::where('user_id', $user->id)
            ->with('shop.shopArea', 'shop.shopGenre')->get();

        $courses = Course::all();

        return view('mypage', compact('user', 'visited_records', 'future_reservations', 'favorites', 'courses'));
    }
}
