<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Review;
use Carbon\Carbon;
use App\Http\Requests\ReviewRequest;


class ReviewController extends Controller
{
    public function showReviewForm($reservation_id)
    {
        $shop_id = Reservation::where('id', $reservation_id)->first()->shop_id;
        $shop = Shop::where('id', $shop_id)->with('shopArea', 'shopGenre')->first();

        return view('review', compact('shop'));
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
