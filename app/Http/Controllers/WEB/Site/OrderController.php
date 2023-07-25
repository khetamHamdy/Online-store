<?php

namespace App\Http\Controllers\WEB\Site;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use setasign\Fpdi\FpdiTrait;

class OrderController extends Controller
{
    protected $items;
    protected $discount_price;
    protected $price;

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
        $items = Cart::with('product')
            ->where('user_id', Auth('web')->id())->latest()
            ->get();
        $items->sum(function ($item) {
            if (isset($item->product->discount_price)) {
                $this->discount_price = $item->quantity * ($item->product->discount_price + $item->addition->price);
            }
            $this->price = $item->quantity * ($item->product->price + $item->addition->price);
        });


        $user = Auth('web')->user();


        $countries = Country::where('status', 'active')->latest()->get();
        $citys = City::where('status', 'active')->latest()->get();
        return view('website.checkout-user',
            [
                'user' => $user,
                'countries' => $countries,
                'citys' => $citys,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
            ]
        );
    }

    public function index_checkout()
    {
        $items = Cart::with('product')
            ->where('user_id', Auth('web')->id())->latest()
            ->get();
        $items->sum(function ($item) {
            if (isset($item->product->discount_price)) {
                $this->discount_price = $item->quantity * ($item->product->discount_price + $item->addition->price);
            }
            $this->price = $item->quantity * ($item->product->price + $item->addition->price);
        });


        $user = Auth('web')->user();


        $countries = Country::where('status', 'active')->latest()->get();
        $citys = City::where('status', 'active')->latest()->get();
        return view('website.checkout-not-auth',
            [
                'user' => $user,
                'countries' => $countries,
                'citys' => $citys,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
            ]
        );
    }

 
}
