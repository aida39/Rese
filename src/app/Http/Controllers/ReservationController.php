<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;


class ReservationController extends Controller
{
    public function createReservation(Request $request)
    {
        $user_id = Auth::id();
        $reservation_data = $request->only(['shop_id', 'reservation_date', 'reservation_time', 'member_count']);
        $reservation_data['user_id'] = $user_id;
        Reservation::create($reservation_data);
        return redirect('/done');
    }

    public function updateReservation(Request $request)
    {
        $user_id = Auth::id();
        $reservation_data = $request->only(['shop_id', 'reservation_date', 'reservation_time', 'member_count']);
        $reservation_data['user_id'] = $user_id;

        $reservation_id = $request->id;
        $reservation = Reservation::find($reservation_id);
        $reservation->update($reservation_data);

        return redirect('/change');
    }

    public function deleteReservation(Request $request)
    {
        Reservation::find($request->id)->delete();
        return redirect()->back();
    }

    public function doneReservation()
    {
        return view('reservation_done');
    }

    public function changeReservation()
    {
        return view('reservation_change');
    }

}
