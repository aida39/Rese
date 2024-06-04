<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function showReviewForm($reservation_id)
    {
        $shop_id = Reservation::where('id', $reservation_id)->first()->shop_id;
        $shop = Shop::where('id', $shop_id)->with('shopArea', 'shopGenre')->first();

        return view('review', compact('shop', 'reservation_id'));
    }

    public function createReview(ReviewRequest $request)
    {
        $review_data = $request->only(['reservation_id', 'rating', 'comment']);

        $directory = env('APP_ENV') === 'production'
        ? env('PROD_IMAGE_DIRECTORY')
        : env('DEV_IMAGE_DIRECTORY');
        $file = Storage::disk('s3')->put($directory, $request->file('image'));
        $review_data['image_path'] = Storage::disk('s3')->url($file);

        Review::create($review_data);
        return redirect('/done/review');
    }

    public function doneReview()
    {
        return view('review_done');
    }

    public function deleteReview(Request $request)
    {
        Review::find($request->review_id)->delete();

        return redirect()->back();
    }
}
