<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ColorsController extends Controller
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
                if (can(['colors-show', 'colors-create', 'colors-edit', 'colors-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('colors-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('colors-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('colors-delete')) {
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
        $items = Color::latest()->paginate($this->settings->paginateTotal);
        return view('admin.colors.home', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
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
            'code' => 'required',
            'name' => 'required|string'
        ];

        $this->validate($request, $roles);

        $item = new Color();
        $item->code = $request->code;
        $item->name = $request->name;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('إضافة لون جديد');
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
        $item = Color::find($id);
        return view('admin.colors.edit', compact('item'));
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
            'code' => 'required',
            'name' => 'required|string'
        ];

        $this->validate($request, $roles);

        $item = Color::find($id);
        $item->code = $request->code;
        $item->name = $request->name;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل لون جديد');
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
        return redirect()->route('color.index')->with('info', __("done_deleted"));
    }

}
