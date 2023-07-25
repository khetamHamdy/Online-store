<?php

namespace App\Http\Controllers\WEB\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Language;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected $items;

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        $this->silders = Slider::query()->where('status', 'active')->get();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,
            'silders' => $this->silders,
        ]);
    }

    public function index()
    {
        return view('website.cart');
    }

    public function update_quantity(Request $request)
    {
        $CartId = $request->input('CartId');
        $action = $request->input('action');
        $cart = Cart::where('id', $CartId)
            ->where('cookie_id', Cookie::get('cart_cookie_id'))
            ->first();

        if ($action === 'increase') {
            $cart->quantity += 1;
        } elseif ($action === 'decrease' && $cart->quantity > 1) {
            $cart->quantity -= 1;
        }
        $cart->save();

        $itemTotalPrice = $cart->quantity * ($cart->price + $cart->addition->price);

        $carts = Cart::where('cookie_id', Cookie::get('cart_cookie_id'))->latest()
            ->get();

        $overallTotalPrice = $carts->sum(function ($item) {
            return $item->quantity * ($item->price + $item->addition->price);
        });

        if ($cart->save()) {
            return response()->json(['quantity' => $cart->quantity,
                'itemTotalPrice' => $itemTotalPrice,
                'overallTotalPrice' => $overallTotalPrice,
            ]);
        }
    }

}
