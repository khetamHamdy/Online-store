<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Language;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Traits\imageTrait;

class ExtraController extends Controller
{

    use imageTrait;

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,
        ]);


        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {

            if ($route_name == 'index') {
                if (can(['extra-show', 'extra-create', 'extra-edit', 'extra-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('extra-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('extra-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('extra-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->back()->withErrors(__('cp.you_dont_have_permission'));
        });

    }

    public function index()
    {
        $items = Extra::filter()->orderBy('id', 'desc')->paginate($this->settings->paginateTotal);
        return view('admin.extras.home', [
            'items' => $items,
        ]);
    }


    public function create()
    {
        $products = Product::where('status', 'active')->latest()->get();
        return view('admin.extras.create', compact('products'));
    }


    public function store(Request $request)
    {
        $roles = [
            'price' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }
        $this->validate($request, $roles);

        $item = new Extra();
        $item->product_id = $request->product_id;
        $item->price = $request->price;

        foreach ($locales as $locale) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }


        $item->save();
        activity()->causedBy(auth('admin')->user())->log('إضافة اضافات جديد');
        return back()->with('status', __('cp.create'));
    }


    public function edit($id)
    {
        $products = Product::where('status', 'active')->latest()->get();

        $item = Extra::where('id', $id)->first();
        return view('admin.extras.edit', [
            'item' => $item,
            'products'=>$products,
        ]);
    }

    public function update(Request $request, $id)
    {

        $roles = [
            'price' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }
        $this->validate($request, $roles);

        $item = Extra::query()->findOrFail($id);

        $item->product_id = $request->product_id;
        $item->price = $request->price;

        foreach ($locales as $locale) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل اضافة ');
        return redirect()->back()->with('status', __('cp.update'));
    }


}
