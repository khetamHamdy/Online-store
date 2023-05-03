<?php


namespace App\Http\Controllers\WEB\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

use Image;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
            if (can('permissions')) {
                return $next($request);
            }
            if ($route_name == 'index') {
                if (can(['permissions-show', 'permissions-create', 'permissions-edit', 'permissions-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('permissions-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('permissions-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('permissions-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
        });
    }

    public function index()
    {
        //
        $items = Permission::orderBy('id', 'desc')->paginate(30);

        return view('admin.permissions.home', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.permissions.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        $permissions = [

        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $permissions['name_' . $locale] = 'required';
        }
        $this->validate($request, $permissions);

        $slug = strtolower(str_replace('-', ' ', $request->name_en));
        if ($request->show) {
            $item_show = new Permission();
            $item_show->translateOrNew('ar')->name = ' عرض ' . $request->name_ar;
            $item_show->translateOrNew('en')->name = ' Show ' . $request->name_en;
            $item_show->slug = $slug . '-show';
            $item_show->save();
        }
        if ($request->create) {
            $item_create = new Permission();
            $item_create->translateOrNew('ar')->name = ' اضافة ' . $request->name_ar;
            $item_create->translateOrNew('en')->name = ' Create ' . $request->name_en;
            $item_create->slug = $slug . '-create';
            $item_create->save();
        }
        if ($request->edit) {
            $item_edit = new Permission();
            $item_edit->translateOrNew('ar')->name = ' تعديل ' . $request->name_ar;
            $item_edit->translateOrNew('en')->name = ' Edit ' . $request->name_en;
            $item_edit->slug = $slug . '-edit';
            $item_edit->save();
        }
        if ($request->delete) {
            $item_delete = new Permission();
            $item_delete->translateOrNew('ar')->name = ' حذف ' . $request->name_ar;
            $item_delete->translateOrNew('en')->name = ' Delete ' . $request->name_en;
            $item_delete->slug = $slug . '-delete';
            $item_delete->save();
        }
        activity()->causedBy(auth('admin')->user())->log(' انشاء الصلاحيات ');

        return redirect()->back()->with('status', __('cp.create'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = Permission::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Permission::findOrFail($id);
        return view('admin.permissions.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $permissions = [
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $permissions['name_' . $locale] = 'required';
        }
        $this->validate($request, $permissions);


        $item = Permission::query()->findOrFail($id);

        foreach ($locales as $locale) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $item->slug = $request->slug;
        $item->save();
        activity()->causedBy(auth('admin')->user())->log(' تعديل الصلاحيات ');

        return redirect()->back()->with('status', __('cp.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = Permission::query()->findOrFail($id);
        if ($item) {
            Permission::query()->where('id', $id)->delete();

            return "success";
        }
        return "fail";
    }
}
