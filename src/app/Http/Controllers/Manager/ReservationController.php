<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function showReservation(Request $request)
    {
        $login_manager_id = Auth::guard('managers')->id();
        $shop_manager_id = Shop::findOrFail($request->id)->manager_id;
        if ($login_manager_id != $shop_manager_id) {
            abort(403, 'このページにアクセスする権限がありません');
        }

        $today = Carbon::now()->format('Y-m-d');
        $reservations = Reservation::where('shop_id', $request->id)
            ->whereDate('reservation_date', '>=', $today)->with('shop')->get();
        foreach ($reservations as $reservation) {
            $reservation->formatted_time = Carbon::parse($reservation->reservation_time)->format('H:i');
        }
        $reservations = $reservations->isEmpty() ? collect() : $reservations;
        return view('manager/reservation', compact('reservations'));
    }
}
