<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\Color;
use App\Models\Country;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PromoCodesController extends Controller
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
                if (can(['promoCodes-show', 'promoCodes-create', 'promoCodes-edit', 'promoCodes-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('promoCodes-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('promoCodes-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('promoCodes-delete')) {
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
        $items = PromoCode::latest()->paginate($this->settings->paginateTotal);
        return view('admin.promoCodes.home', compact('items',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promoCodes.create');
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
            'promo_code_name' => 'required|string',
            'promo_code_amount' => 'required',
            'promo_code_type' => 'required',
        ];

        $this->validate($request, $roles);

        $item = new PromoCode();
        $item->promo_code_name = $request->promo_code_name;
        $item->promo_code_amount = $request->promo_code_amount;
        $item->promo_code_type = $request->promo_code_type;
        $item->discount = $request->discount;
        $item->save();


        activity()->causedBy(auth('admin')->user())->log('إضافة بروم كود  جديد');
        return back()->with('status', __('cp.create'));
    }


    public function edit($id)
    {
        $item = PromoCode::find($id);
        return view('admin.promoCodes.edit', compact('item'));
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
            'promo_code_name' => 'required|string',
            'promo_code_amount' => 'required',
            'promo_code_type' => 'required',
        ];

        $this->validate($request, $roles);

        $item = PromoCode::find($id);
        $item->promo_code_name = $request->promo_code_name;
        $item->promo_code_amount = $request->promo_code_amount;
        $item->promo_code_type = $request->promo_code_type;
        $item->discount = $request->discount;

        $done = $item->save();
        activity()->causedBy(auth('admin')->user())->log('تعديل  بروم كود جديد');

        return back()->with('status', __('cp.update'));
    }
}
