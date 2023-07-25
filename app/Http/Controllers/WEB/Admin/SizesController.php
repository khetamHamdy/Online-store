<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SizesController extends Controller
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
                if (can(['sizes-show', 'sizes-create', 'sizes-edit', 'sizes-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('sizes-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('sizes-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('sizes-delete')) {
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
        $items = Size::latest()->paginate($this->settings->paginateTotal);
        return view('admin.sizes.home', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create');
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
            'size' => 'required|string'
        ];

        $this->validate($request, $roles);

        $item = new Size();
        $item->size = $request->size;


        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('إضافة الحجم جديد');
        return back()->with('status', __('cp.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sizes $color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Size::find($id);
        return view('admin.sizes.edit', compact('item'));
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
            'size' => 'required|string'
        ];

        $this->validate($request, $roles);

        $item = Size::find($id);
        $item->size = $request->size;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل الحجم جديد');
        return back()->with('status', __('cp.update'));
    }

}
