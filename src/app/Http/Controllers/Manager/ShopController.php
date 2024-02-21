<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\ShopArea;
use App\Models\ShopGenre;
use App\Http\Requests\ShopRequest;


class ShopController extends Controller
{
    public function index()
    {
        $manager = Auth::guard('managers')->user();
        $shops = shop::with('shopArea', 'shopGenre')->where('manager_id', $manager->id)->get();
        return view('manager/index', compact('shops', 'manager'));
    }

    public function create()
    {
        $shop_areas = ShopArea::all();
        $shop_genres = ShopGenre::all();
        return view('manager/create', compact('shop_areas', 'shop_genres',));
    }

    public function store(ShopRequest $request)
    {
        $manager_id = Auth::guard('managers')->id();
        $shop_data = $request->only(['shop_area_id', 'shop_genre_id', 'shop_name', 'shop_description']);
        $shop_data['manager_id'] = $manager_id;
        Shop::create($shop_data);
        return view('manager/create_done');
    }

    public function edit(Request $request)
    {
        $login_manager_id = Auth::guard('managers')->id();
        $shop_manager_id = Shop::findOrFail($request->id)->manager_id;
        if ($login_manager_id != $shop_manager_id) {
            abort(403, 'このページにアクセスする権限がありません');
        }

        $shop_areas = ShopArea::all();
        $shop_genres = ShopGenre::all();
        $shop_id = $request->input('id');
        $shop = Shop::with('shopArea', 'shopGenre')->findOrFail($shop_id);
        return view('manager/edit', compact('shop', 'shop_areas', 'shop_genres',));
    }

    public function update(ShopRequest $request)
    {
        $shop_data = $request->only(['shop_area_id', 'shop_genre_id', 'shop_name', 'shop_description']);
        $shop = Shop::find($request->id);
        $shop->update($shop_data);
        return view('manager/edit_done');
    }
}
