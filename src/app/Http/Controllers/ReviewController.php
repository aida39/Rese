<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Review;
use Carbon\Carbon;
use App\Http\Requests\ReviewRequest;


class ReviewController extends Controller
{
    public function showReviewForm($reservation_id)
    {
        $reservation = Reservation::where('id', $reservation_id)->with('shop')->first();
        if (!$reservation || $reservation->user_id !== Auth::id()) {
            abort(403, 'このページにアクセスする権限がありません。');
        }
        $reservation->formatted_time = Carbon::parse($reservation->reservation_time)->format('H:i');
        return view('review', compact('reservation'));
    }

    public function createReview(ReviewRequest $request)
    {
        $review_data = $request->only(['reservation_id', 'rating', 'comment']);
        Review::create($review_data);
        return redirect('/done/review');
    }

    public function doneReview()
    {
        return view('review_done');
    }
}
