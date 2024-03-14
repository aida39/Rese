<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Review;

class ReviewController extends Controller
{
    public function showReview(Request $request)
    {
        $login_manager_id = Auth::guard('managers')->id();
        $shop_manager_id = Shop::findOrFail($request->id)->manager_id;
        if ($login_manager_id != $shop_manager_id) {
            abort(403, 'このページにアクセスする権限がありません');
        }

        $id = $request->input('id');
        $reviews = Review::with(['reservation' => function ($query) use ($id) {
            $query->where('shop_id', $id);
        }, 'reservation.shop', 'reservation.user'])
            ->whereHas('reservation', function ($query) use ($id) {
                $query->where('shop_id', $id);
            })
            ->get();
        $reviews = $reviews->isEmpty() ? collect() : $reviews;
        return view('manager/review', compact('reviews'));
    }
}
