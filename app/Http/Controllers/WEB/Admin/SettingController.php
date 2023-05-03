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

class SettingController extends Controller
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
         if(can('settings')){
            return $next($request);
         }
          if($route_name== 'index' ){
             if(can(['settings-show' , 'settings-edit'])){
                 return $next($request);
             }
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('settings-edit')){
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
        return view('admin.settings.edit', ['item' => $item]);
    }

    public function system_maintenance()
    {
        $item = Setting::query()->first();
        return view('admin.settings.editMaintanense', ['item' => $item]);
    }


    public function update(Request $request)
    {

        $roles = [
            'login_image' => 'image|mimes:jpeg,jpg,png,svg',
            'info_email' => 'required|email',
            'mobile' => 'required|numeric',
            'twitter' => 'required|url',
            'paginateTotal' => 'required|numeric',
            'instagram' => 'required|url',
            'google_play_url' => 'required|url',
            'app_store_url' => 'required|url',
        ];

        $this->validate($request, $roles);
        $setting = Setting::query()->findOrFail(1);

        $setting->info_email = trim($request->get('info_email'));
        $setting->mobile = trim($request->get('mobile'));
        $setting->paginateTotal = trim($request->get('paginateTotal'));
        $setting->instagram = trim($request->get('instagram'));
        $setting->twitter = trim($request->get('twitter'));
        $setting->google_play_url = trim($request->get('google_play_url'));
        $setting->app_store_url = trim($request->get('app_store_url'));

        if ($request->hasFile('login_image')) {
            $setting->login_image =  $this->storeImage( $request->file('login_image'), 'settings',$setting->getRawOriginal('login_image'),null,512);
        }


        $setting->save();

        return redirect()->back()->with('status', __('cp.update'));
    }


    public function update_system_maintenance(Request $request)
    {
       $setting = Setting::query()->findOrFail(1);
        if($request->get('is_maintenance_mode') == 'on'){
             $setting->is_maintenance_mode = '1' ;
        }else{
             $setting->is_maintenance_mode = '0' ;
        }

        if($request->get('is_allow_register') == 'on'){
             $setting->is_allow_register = '1' ;
        }else{
             $setting->is_allow_register = '0' ;
        }

        if($request->get('is_allow_login') == 'on'){
             $setting->is_allow_login = '1' ;
        }else{
             $setting->is_allow_login = '0' ;
        }

        if($request->get('is_allow_buy') == 'on'){
             $setting->is_allow_buy = '1' ;
        }else{
             $setting->is_allow_buy = '0' ;
        }

        $setting->save();

        if($request->get('is_maintenance_mode') == 'on'){
             \Artisan::call('down');
             $setting->is_maintenance_mode = '1' ;
        }else{
             \Artisan::call('up');
             $setting->is_maintenance_mode = '0' ;
        }
          $setting->save();
        return redirect()->back()->with('status', __('cp.update'));
    }


}
