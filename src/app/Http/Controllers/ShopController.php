<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\ShopArea;
use App\Models\ShopGenre;
use App\Models\Favorite;
use App\Models\Reservation;
use Carbon\Carbon;

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
            }])->get();
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
        return view('detail', compact('shop'));
    }

    public function mypage()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('shop')->get();
        foreach ($reservations as $reservation) {
            $reservation->formatted_time = Carbon::parse($reservation->reservation_time)->format('H:i');
        }
        $favorites = Favorite::where('user_id', $user->id)->with('shop.shopArea', 'shop.shopGenre')->get();
        return view('mypage', compact('user', 'reservations', 'favorites'));
    }
}
