<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Models\Admin;
use App\Models\City;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\UserPermission;
use App\Models\AdminRole;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;

use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Route;
class AdminController extends Controller
{

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf');

    }


    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);

         $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);
         $this->middleware(function ($request, $next) use($route_name){
          if($route_name== 'index' ){
             if(can(['admins-show' , 'admins-create' , 'admins-edit' , 'admins-delete'])){
                 return $next($request);
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('admins-create')){
                 return $next($request);
             }
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('admins-edit')){
                 return $next($request);
             }
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('admins-delete')){
                 return $next($request);
             }
          }else{
              return $next($request);
          }
          return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
        });

    }

    public function index(Request $request)
    {
        $items = Admin::where('id','!=',auth('admin')->user()->id)->where('id','!=','1')->filter()->orderByDesc('id')->paginate($this->settings->paginateTotal);
        return view('admin.admin.home', [
            'items' => $items,
        ]);

    }

    public function destroy($id)
    {
        $item = Admin::query()->findOrFail($id);
        if ($item && $item->type != 1) {
            Admin::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }


    public function create()
    {
        $users = Admin::all();
        $roles=Role::orderBy('id','desc')->get();
        return view('admin.admin.create',compact('users','roles'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
            'mobile'=>'required|digits_between:8,12|unique:admins',
            'roles'=>'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin = new Admin();
        $newAdmin->name=$request->name;
        $newAdmin->email=$request->email;
        $newAdmin->password=bcrypt($request->password);
        $newAdmin->mobile=$request->mobile;
        $newAdmin->status='active';

        $newAdmin->save();

         if($request->roles != null){
            foreach($request->roles as $roleId){
                $values[] = [
                    'admin_id' => $newAdmin->id,
                    'role_id' => $roleId,
                ];
            }
            AdminRole::insert($values);

        }

        return redirect()->route('admin.admins.all')->with('status', __('cp.create'));

    }



    public function edit($id)
    {
        //dd($id);
        $item = Admin::with('roles')->findOrFail($id);
         $roles=Role::orderBy('id','desc')->get();
        return view('admin.admin.edit',compact('item','roles'));


    }


    public function update(Request $request, $id)
    {
        $newAdmin= Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'mobile'=>'required|digits_between:8,12|unique:admins,mobile,'.$newAdmin->id,
            'email'=>'required|email|unique:admins,email,'.$newAdmin->id,
            'roles'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = Admin::where('email',$request->email)->where('id','<>',$id)->first();
        if($check){
            $validator=[__('cp.whoops')];
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin->name=$request->name;
        $newAdmin->mobile=$request->mobile;
        $newAdmin->email=$request->email;

        $newAdmin->save();

       if($request->roles != null){
            foreach($request->roles as $roleId){
                $values[] = [
                    'admin_id' => $newAdmin->id,
                    'role_id' => $roleId,

                ];
            }
            AdminRole::where('admin_id',$newAdmin->id)->delete();
            AdminRole::insert($values);

        }

        return redirect()->back()->with('status', __('cp.update'));

    }



    public function edit_password(Request $request, $id)
    {
        $item = Admin::findOrFail($id);
        return view('admin.admin.edit_password',['item'=>$item]);
    }


    public function update_password (Request $request, $id)
    {
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = Admin::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();



        return redirect()->back()->with('status', __('cp.update'));
    }



    public function editMyProfile()
    {
        $item = Admin::findOrFail(auth()->guard('admin')->user()->id);
        return view('admin.admin.edit_profile',compact('item'));
    }




    public function updateProfile(Request $request)
    {
        $newAdmin= Admin::findOrFail(auth()->guard('admin')->user()->id);

        $validator = Validator::make($request->all(), [
            'email'=>'required|string',
            'name'=>'required|string',
            'mobile'=>'required|digits_between:8,12|unique:admins,mobile,'.$newAdmin->id,

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = Admin::findOrFail(auth()->guard('admin')->user()->id);
        if(!$check){
            $validator=[__('api.whoops')];
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin->name=$request->name;
        $newAdmin->mobile=$request->mobile;
        $newAdmin->email=$request->email;

           if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/users/$file_name");
            $newAdmin->image = $file_name;
        }

        $newAdmin->save();

       return redirect()->back()->with('status', __('cp.update'));

    }


    public function changeMyPassword()
    {
        $item = Admin::findOrFail(auth()->guard('admin')->user()->id);
        return view('admin.admin.changeMyPassword',compact('item'));
    }

    public function updateMyPassword (Request $request)
    {

        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = Admin::findOrFail(auth()->guard('admin')->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();



        return redirect()->back()->with('status', __('cp.update'));
    }

}
