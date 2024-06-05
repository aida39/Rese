<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;
use App\Models\ShopArea;
use App\Models\ShopGenre;
use App\Models\Review;
use App\Models\Course;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shop_areas = ShopArea::all();
        $shop_genres = ShopGenre::all();
        $user_id = Auth::id();
        $shops = Shop::with('shopArea', 'shopGenre')
            ->with(['favorite' => function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            }])
            ->get();

        return view('index', compact('shop_areas', 'shop_genres', 'shops'));
    }

    public function search(Request $request)
    {
        $selected_area = $request->shop_area_id;
        $selected_genre = $request->shop_genre_id;
        $keyword = $request->keyword;

        $shop_areas = ShopArea::all();
        $shop_genres = ShopGenre::all();
        $shops = Shop::with('shopArea', 'shopGenre')
            ->AreaSearch($selected_area)
            ->GenreSearch($selected_genre)
            ->KeywordSearch($keyword)->get();

        $sort = $request->input('sort');

        if ($sort == 'random') {
            $shops = $shops->shuffle();
        } elseif ($sort == "high_rating") {
            $shops = $shops->sortByDesc(function ($shop) {
                return $shop->reviews->avg('rating');
            });
        } elseif ($sort == "low_rating") {
            $shops = $shops->sortBy(function ($shop) {
                $averageRating = $shop->reviews->avg('rating');
                return is_null($averageRating) ? PHP_INT_MAX : $averageRating;
            });
        }

        return view('index', compact('selected_area', 'selected_genre', 'keyword', 'shop_areas', 'shop_genres', 'shops', 'sort'));
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $shop = Shop::with('shopArea', 'shopGenre')->findOrFail($id);
        $courses = Course::all();
        $reviews = Review::with(['reservation' => function ($query) use ($id) {
            $query->where('shop_id', $id);
        }, 'reservation.shop', 'reservation.user', 'reservation.course'])
            ->whereHas('reservation', function ($query) use ($id) {
                $query->where('shop_id', $id);
            })
            ->get();

        foreach($reviews as $review){
            $review->is_user_review = $review->reservation->user_id === Auth::id();
        }

        return view('detail', compact('shop', 'courses', 'reviews'));
    }
}
