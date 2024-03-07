<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\ShopArea;
use App\Models\ShopGenre;
use App\Models\Review;
use App\Models\Course;

class ShopController extends Controller
{
    public function index()
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
        $shop_areas = ShopArea::all();
        $shop_genres = ShopGenre::all();
        $shops = Shop::with('shopArea', 'shopGenre')
            ->AreaSearch($request->shop_area_id)
            ->GenreSearch($request->shop_genre_id)
            ->KeywordSearch($request->keyword)->get();
        return view('index', compact('shop_areas', 'shop_genres', 'shops'));
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $shop = Shop::with('shopArea', 'shopGenre')->findOrFail($id);
        $courses = Course::all();
        $reviews = Review::with(['reservation' => function ($query) use ($id) {
            $query->where('shop_id', $id);
        }, 'reservation.shop', 'reservation.user','reservation.course'])
            ->whereHas('reservation', function ($query) use ($id) {
                $query->where('shop_id', $id);
            })
            ->get();
        return view('detail', compact('shop', 'courses', 'reviews'));
    }
}
