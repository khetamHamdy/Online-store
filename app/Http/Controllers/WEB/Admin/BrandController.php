<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Language;
use App\Models\Product;
use App\Models\Setting;
use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *8
     * @return \Illuminate\Http\Response
     */
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
                if (can(['brand-show', 'brand-create', 'brand-edit', 'brand-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('brand-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('brand-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('brand-delete')) {
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
        $items = Brand::orderBy('id', 'desc')->paginate($this->settings->paginateTotal);

        return view('admin.brand.home', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::latest()->get();
        return view('admin.brand.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $roles = [
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }
        $this->validate($request, $roles);

        $item = new Brand();

        foreach ($locales as $locale) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('إضافة براند جديد');
        return back()->with('status', __('cp.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param brand $color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::latest()->get();
        $item = Brand::find($id);
        return view('admin.brand.edit', compact('item', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Color $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roles = [
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }
        $this->validate($request, $roles);

        $item = Brand::find($id);
        foreach ($locales as $locale) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل الحجم جديد');
        return back()->with('status', __('cp.update'));
    }

}
