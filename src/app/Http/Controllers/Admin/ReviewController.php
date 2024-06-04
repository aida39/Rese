<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Review;

class ReviewController extends Controller
{
    public function showReviewForm()
    {
        $reviews=Review::with('reservation.shop', 'reservation.user')->get();
        // $shop_id = Reservation::where('id', $reservation_id)->first()->shop_id;
        // $shop = Shop::where('id', $shop_id)->with('shopArea', 'shopGenre')->first();

        return view('admin/review', compact('reviews'));
    }

    public function deleteReview(Request $request)
    {
        Review::find($request->review_id)->delete();

        return redirect()->back();
    }
}
