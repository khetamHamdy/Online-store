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

class CountryController extends Controller
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
                if (can(['country-show', 'country-create', 'country-edit', 'country-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('country-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('country-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('country-delete')) {
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
        $items = Country::latest()->paginate($this->settings->paginateTotal);
        return view('admin.country.home', compact('items', ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
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
        ];

        $this->validate($request, $roles);

        $itemCity = new City();
        $itemCity->name = $request->name_city;
        $itemCity->save();

        activity()->causedBy(auth('admin')->user())->log('إضافة  دولة جديد');
        return back()->with('status', __('cp.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param country $color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Country::find($id);
        return view('admin.country.edit', compact('item'));
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
            'name' => 'required|string'
        ];

        $this->validate($request, $roles);

        $item = Country::find($id);
        $item->name = $request->name;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل دولة جديد');

        return back()->with('status', __('cp.update'));
    }

}
