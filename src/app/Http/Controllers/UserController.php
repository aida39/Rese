<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Reservation;
use Carbon\Carbon;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $today = Carbon::now()->format('Y-m-d');
        $past_reservations = Reservation::where('user_id', $user->id)
            ->whereDate('reservation_date', '<', $today)->with('shop')->get();
        $future_reservations = Reservation::where('user_id', $user->id)
            ->whereDate('reservation_date', '>=', $today)->with('shop')->get();

        foreach ($past_reservations as $reservation) {
            $reservation->formatted_time = Carbon::parse($reservation->reservation_time)->format('H:i');
            $reservation->is_reviewed = $reservation->review()->exists();
        }

        foreach ($future_reservations as $future_reservation) {
            $future_reservation->formatted_time = Carbon::parse($future_reservation->reservation_time)->format('H:i');
        }

        $favorites = Favorite::where('user_id', $user->id)
            ->with('shop.shopArea', 'shop.shopGenre')
            ->get();

        return view('mypage', compact('user', 'past_reservations', 'future_reservations', 'favorites'));
    }
}
