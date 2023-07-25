<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Color;
use App\Models\Country;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CityController extends Controller
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
                if (can(['city-show', 'city-create', 'city-edit', 'city-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('city-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('city-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('city-delete')) {
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
        $items = City::latest()->paginate($this->settings->paginateTotal);
        return view('admin.city.home', compact('items', ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::where('status','active')->latest()->get();
        return view('admin.city.create',compact('countries'));
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
            'name' => 'required|string',
            'country_id' => 'required',
        ];

        $this->validate($request, $roles);

        $itemCity = new City();
        $itemCity->name = $request->name;
        $itemCity->country_id = $request->country_id;
        $itemCity->price = $request->price;
        $itemCity->save();


        activity()->causedBy(auth('admin')->user())->log('إضافة مدينة  جديد');
        return back()->with('status', __('cp.create'));
    }



    public function edit($id)
    {
        $countries=Country::where('status','active')->latest()->get();
        $item = City::find($id);
        return view('admin.city.edit', compact('item','countries'));
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
            'name' => 'required|string',
            'country_id' => 'required',
            'price' => 'required',
        ];

        $this->validate($request, $roles);

        $item = City::find($id);
        $item->name = $request->name;
        $item->country_id = $request->country_id;
        $item->price = $request->price;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل مدينة جديد');

        return back()->with('status', __('cp.update'));
    }
}
