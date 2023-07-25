<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Language;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class OffersController extends Controller
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
                if (can(['offers-show', 'offers-create', 'offers-edit', 'offers-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('offers-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('offers-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('offers-delete')) {
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
        $items = Offer::latest()->paginate($this->settings->paginateTotal);
        return view('admin.offers.home', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::latest()->get();
        return view('admin.offers.create', ['products' => $products]);
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
            'product_id' => 'required',
            'discount' => 'required',
            'start_offer' => 'required|date',
            'end_offer' => 'required|date',
        ];

        $this->validate($request, $roles);

        $item = new Offer();
        $item->product_id = $request->product_id;
        $item->discount = $request->discount;
        $item->start_offer = $request->start_offer;
        $item->end_offer = $request->end_offer;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('إضافة العرض جديد');
        return back()->with('status', __('cp.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Color $color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Offer::find($id);
        $products = Product::latest()->get();

        return view('admin.offers.edit', compact('item', 'products'));
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
            'product_id' => 'required',
            'discount' => 'required',
            'start_offer' => 'required|date',
            'end_offer' => 'required|date',
        ];

        $this->validate($request, $roles);

        $item = Offer::find($id);
        $item->product_id = $request->product_id;
        $item->discount = $request->discount;
        $item->start_offer = $request->start_offer;
        $item->end_offer = $request->end_offer;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل العرض جديد');
        return back()->with('status', __('cp.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('offers.index')->with('info', __("done_deleted"));
    }

}
