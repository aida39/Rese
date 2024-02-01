<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopArea;
use App\Models\ShopGenre;

class CustomerController extends Controller
{
    public function index()
    {
        $shop_areas = ShopArea::all();
        $shop_genres = ShopGenre::all();
        $shops = Shop::with('shopArea', 'shopGenre')->get();
        return view('index', compact('shop_areas', 'shop_genres','shops'));
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

    public function thanks()
    {
        return view('thanks');
    }

    public function guestMenu()
    {
        return view('menu_guest');
    }
}
