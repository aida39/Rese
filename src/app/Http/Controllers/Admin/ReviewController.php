<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function showReviewForm()
    {
        $reviews=Review::with('reservation.shop', 'reservation.user')->get();

        return view('admin/review', compact('reviews'));
    }

    public function deleteReview(Request $request)
    {
        Review::find($request->review_id)->delete();

        return redirect()->back();
    }
}
