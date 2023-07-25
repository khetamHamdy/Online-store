<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Setting;
use App\Traits\imageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

class HomePageController extends Controller
{
    private $locales = '';
    use imageTrait;
    public function __construct()
    {
        $this->locales = Language::all();
        view()->share([
            'locales' => $this->locales,
        ]);

          $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);
         $this->middleware(function ($request, $next) use($route_name){
         if(can('homePage')){
            return $next($request);
         }
          if($route_name== 'index' ){
             if(can(['homePage-show' , 'homePage-edit'])){
                 return $next($request);
             }
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('homePage-edit')){
                 return $next($request);
             }
          }else{
              return $next($request);
          }
          return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
        });
    }


    public function image_extensions(){
      return array('jpg','png','jpeg','gif','bmp','pdf','txt','docx','doc','ppt','xls','zip','rar');
    }

    public function index()
    {
        $item = Setting::query()->first();
        return view('admin.homePage.index', ['item' => $item]);
    }
    public function update(Request $request)
    {
        
        $setting = Setting::query()->findOrFail(1);

        $roles = [
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['banner_text_' . $locale] = 'required';
            $roles['who_we_are_description_' . $locale] = 'required';
            $roles['what_we_do_description_' . $locale] = 'required';
        }

        $this->validate($request, $roles);

        foreach ($locales as $locale) {
            $setting->translate($locale)->banner_text = $request->get('banner_text_' . $locale);
            $setting->translate($locale)->who_we_are_description = $request->get('who_we_are_description_' . $locale);
            $setting->translate($locale)->what_we_do_description = $request->get('what_we_do_description_' . $locale);
        }
        if ($request->hasFile('login_image')) {
            $setting->login_image =  $this->storeImage( $request->file('login_image'), 'settings',$setting->getRawOriginal('login_image'),null,512);
        }

        $setting->save();
        return redirect()->back()->with('status', __('cp.update'));
    }


}
