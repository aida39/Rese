<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class FavoriteController extends Controller
{
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

}
