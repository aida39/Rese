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

class CustomerController extends Controller
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

    public function switchFavoriteStatus(Request $request, $shop_id)
    {
        $user_id = Auth::id();
        $shop = Shop::findOrFail($shop_id);
        if ($shop->favorite->where('user_id', $user_id)->count() > 0) {
            $shop->favorite()->where('user_id', $user_id)->delete();
        } else {
            $shop->favorite()->create(['user_id' => $user_id]);
        }
        return redirect()->back();
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $shop = Shop::with('shopArea', 'shopGenre')->findOrFail($id);
        return view('detail', compact('shop'));
    }

    public function createReservation(Request $request)
    {
        $user_id = Auth::id();
        $reservation_data = $request->only(['shop_id', 'reservation_date', 'reservation_time', 'member_count']);
        $reservation_data['user_id'] = $user_id;
        Reservation::create($reservation_data);
        return redirect('/done');
    }

    public function updateReservation(Request $request)
    {
        $user_id = Auth::id();
        $reservation_data = $request->only(['shop_id', 'reservation_date', 'reservation_time', 'member_count']);
        $reservation_data['user_id'] = $user_id;

        $reservation_id = $request->id;
        $reservation = Reservation::find($reservation_id);
        $reservation->update($reservation_data);

        return redirect('/done');
    }

    public function deleteReservation(Request $request)
    {
        Reservation::find($request->id)->delete();
        return redirect()->back();
    }

    public function done()
    {
        return view('done');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function mypage()
    {
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        $reservations = Reservation::where('user_id', $user_id)->with('shop')->get();
        foreach ($reservations as $reservation) {
            $reservation->formatted_time = Carbon::parse($reservation->reservation_time)->format('H:i');
        }
        $favorites = Favorite::where('user_id', $user_id)->with('shop.shopArea', 'shop.shopGenre')->get();
        return view('mypage', compact('user_name', 'reservations', 'favorites'));
    }
}
