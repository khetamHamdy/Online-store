<?php

namespace App\Http\Controllers\WEB\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Language;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    protected $settings = '';
    protected $silders = '';

    public function __construct()
    {
        $this->locales = Language::all();

        if (Cache::has('setting')) {
            $setting = Cache::get('setting');
        } else {
            $setting = Setting::latest()->first();
            Cache::put('setting', $setting, 60000);
        }

        if (Cache::has('silders')) {
            $silder = Cache::get('silders');
        } else {
            $silder = Slider::query()->where('status', 'active')->get();
            Cache::put('silders', $silder, 60000);
        }

        $this->settings = $setting;
        $this->silders = $silder;

        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,
            'silders' => $this->silders,
        ]);
    }

    public function index(Request $request)
    {
        if (Cache::has('best_products')) {
            $best_products = Cache::get('best_products');
        } else {
            $best_products = Product::where('status', 'active')->where('is_best_product', 'on')->latest()->paginate(9);
            Cache::put('best_products', $best_products, 60000);
        }

        if (Cache::has('LatestProducts')) {
            $LatestProducts = Cache::get('LatestProducts');
        } else {
            $LatestProducts = Product::where('status', 'active')->where('is_best_product','<>', 'on')->latest()->paginate(13);
            Cache::put('LatestProducts', $LatestProducts, 60000);
        }

        if (Cache::has('categories')) {
            $categories = Cache::get('categories');
        } else {
            $categories = Category::where('status', 'active')->latest()->get();
            Cache::put('categories', $categories, 60000);
        }

        return view('website.home', compact('best_products', 'categories' ,'LatestProducts'));
    }

    public function productAll(Request $request)
    {
        if (Cache::has('products')) {
            $products = Cache::get('products');
        } else {
            $products = Product::where('status', 'active')->filter()->latest()->get();
            Cache::put('products', $products, 60000);
        }

        return view('website.home_products', compact('products'));
    }

    public function search_products(Request $request)
    {
        $request->validate([
            'title' => 'max:255|min:5',
        ]);
        $params = $request->query->get('title');
        $products = Product::where(function ($q) use ($params) {
            $q->whereTranslationLike('title', '%' . $params . '%');
        })->latest()->get();
        return view('website.search_products', compact('products', 'params'));
    }

    public function category_products($id)
    {
        $products = Product::where('category_id', $id)->get();

        return response()->json([$products]);
    }

    public function product_details($id)
    {
        return view('website.product-details');
    }

    public function pages($slug)
    {

        if (Cache::has('item')) {
            $item = Cache::get('item');
        } else {
            $item = Page::where('slug', $slug)->first();
            Cache::put('item', $item, 60000);
        }

        if ($slug == 'contact-us') {
            return view('website.contact', compact('item'));
        }

        if ($item) {
            return view('website.pages', compact('item'));
        }
    }

    public function storeQuote(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|min:4',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => implode("\n", $validator->messages()->all()), 'errors' => $validator->errors(), 'code' => 400]);
        // }

        $quote = new Contact();
        $quote->name = $request->get('name');
        $quote->email = $request->get('email');
        $quote->phone = $request->get('phone');
        $quote->message = $request->get('message');
        $quote->save();
        return response()->json(['status' => true, 'code' => 200]);
    }

}
