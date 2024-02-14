<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\ShopArea;
use App\Models\ShopGenre;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;

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
        $reviews = Review::with(['reservation' => function ($query) use ($id) {
                $query->where('shop_id', $id);
            }, 'reservation.shop', 'reservation.user'])
            ->whereHas('reservation', function ($query) use ($id) {
                $query->where('shop_id', $id);
            })
            ->get();
        return view('detail', compact('shop', 'reviews'));
    }

    public function mypage()
    {
        $user = Auth::user();
        $today = Carbon::now()->format('Y-m-d');
        $past_reservations = Reservation::where('user_id', $user->id)
            ->whereDate('reservation_date', '<', $today)->with('shop')->get();
        $future_reservations = Reservation::where('user_id', $user->id)
            ->whereDate('reservation_date', '>=', $today)->with('shop')->get();

        foreach ($past_reservations as $reservation) {
            $reservation->formatted_time = Carbon::parse($reservation->reservation_time)->format('H:i');
            $reservation->is_reviewed = $reservation->review()->exists();
        }

        foreach ($future_reservations as $future_reservation) {
            $future_reservation->formatted_time = Carbon::parse($future_reservation->reservation_time)->format('H:i');
        }

        $favorites = Favorite::where('user_id', $user->id)
            ->with('shop.shopArea', 'shop.shopGenre')
            ->get();


        return view('mypage', compact('user', 'past_reservations', 'future_reservations', 'favorites'));
    }
}
