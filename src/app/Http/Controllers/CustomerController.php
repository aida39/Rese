<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\ShopArea;
use App\Models\ShopGenre;
use App\Models\Favorite;

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

    public function userAttendance(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);
        $page = $request->input('page', 1);
        $worktimes = Worktime::with('user', 'breaktimes')->where('user_id', $id)->paginate(5, ['*'], 'page', $page)->withQueryString();
        return view('user_attendance', compact('user', 'worktimes'));
    }
    
    public function thanks()
    {
        return view('thanks');
    }

    public function guestMenu()
    {
        return view('menu_guest');
    }
}
