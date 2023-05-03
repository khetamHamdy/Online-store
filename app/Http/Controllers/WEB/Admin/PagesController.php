<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Input;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    public function __construct()
    {
        view()->share([
            'locales' => Language::all(),
            'setting' => Setting::query()->first(),
        ]);

        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {

            if ($route_name == 'index') {
                if (can(['pages-show', 'pages-edit'])) {
                    return $next($request);
                }
            }  elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('pages-edit')) {
                    return $next($request);
                }
            }else {
                return $next($request);
            }
            return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
        });
    }


    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');

    }

    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.home', ['pages' => $pages]);
    }


    public function edit($id)
    {
        $item = Page::query()->findOrFail($id);
        return view('admin.pages.edit', ['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $roles = [

            ];
        $page = Page::query()->findOrFail($id);
        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
//            $roles['title_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        $this->validate($request, $roles);

        foreach ($locales as $locale) {
//            $page->translate($locale)->title = $request->get('title_' . $locale);
            $page->translate($locale)->description = $request->get('description_' . $locale);
        }

        if ($page->save()) {
            return redirect()->back()->with('status', __('cp.update'));
        }
        return redirect()->back()->withErrors('errors', ['Page not updated']);
    }

    public function destroy($id)
    {
        $page = Page::query()->findOrFail($id);
        if ($page->delete()) {
            return 'success';
        }
        return 'fail';
    }


}
