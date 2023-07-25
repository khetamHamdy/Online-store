<?php

namespace App\Http\Controllers\WEB\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Quote;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth;
use Illuminate\Support\Facades\Validator;
use Money\Currencies\ISOCurrencies;


class UserController extends Controller
{
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        $this->silders = Slider::query()->where('status', 'active')->get();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,
            'silders' => $this->silders,
        ]);
    }


    public function profile()
    {
        $user = Auth('web')->user();
      $currencies = new ISOCurrencies();
     $currencyList = $currencies->getIterator();


        return view('website.profile.edit-account', [
            'user' => $user,
            'currencies'=>$currencies
        ]);
    }

    public function edit_profile(Request $request)
    {
        $request->validate([
            'user_name' => 'required|min:4',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        $user = Auth('web')->id();

        $item = User::where('id', $user)->first();

        $item->user_name = $request->user_name;
        $item->email = $request->email;
        $item->mobile = $request->mobile;
        $item->currency = $request->currency;

        $item->save();

        return redirect()->back();

    }

    public function change_password()
    {
        $user = Auth('web')->user();
        return view('website.profile.change-password', [
            'user' => $user,
        ]);
    }

    public function edit_change_password(Request $request, $id)
    {

        $hashedPassword = User::find($id)->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            $users_rules = array(
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password|min:6',
            );
            $users_validation = Validator::make($request->all(), $users_rules);

            if ($users_validation->fails()) {
                return redirect()->back()->withErrors($users_validation)->withInput();
            }
            $user = User::findOrFail($id);
            $user->password = bcrypt($request->password);
            $user->save();


            return redirect()->back()->with('status', __('cp.update'));
        } else {
            return 'password not correct';
        }

    }

    public function my_address()
    {
        $user = Auth('web')->user();
        $countries = Country::where('status', 'active')->latest()->get();
        $citys = City::where('status', 'active')->latest()->get();
        $items = UserAddress::query()->where(
            'user_id', $user->id
        )->get();

        return view('website.profile.my-address', [
            'user' => $user,
            'items' => $items,
            'countries' => $countries,
            'citys' => $citys,
        ]);
    }

    public function create_my_address(Request $request)
    {

        $request->validate([
            'street_descriptions' => 'required|string',
            'address_name' => 'required|string',
            'notes' => 'required|string',
            'country_id' => 'required',
            'city_id' => 'required',
        ]);


        $item = new  UserAddress();
        $item->add_name = $request->address_name;
        $item->country_id = $request->country_id;
        $item->user_id = Auth('web')->id();
        $item->city_id = $request->city_id;
        $item->street_descriptions = $request->street_descriptions;
        $item->notes = $request->notes;

        $item->save();
        if ($item->save()) {
            return redirect()->back();
        } else {
            return 123;
        }


    }

//    public function delete_my_address($model)
//    {
//        $role = "";
//        if ($model == "userAddress") $role = 'App\Models\UserAddress';
//
//        return $model;
////        $item = UserAddress::query()->where('id', $id)->where('user_id', Auth('web')->id())
////            ->delete();
////        if ($item) {
////            return response([
////                'message' => 'deleted item'
////            ]);
////        }
//
//    }

    public function changeStatusAddress(Request $request)
    {
        if ($request->action == 'delete') {
            UserAddress::where('id', $request->ID)->delete();
        } else {
            if ($request->action == 'edit') {
                $item = UserAddress::query()->where('id', $request->ID)->first();
                $item->add_name = $request->address_name;
                $item->country_id = $request->country_id;
                $item->user_id = Auth('web')->id() ?? null;
                $item->city_id = $request->city_id;
                $item->street_descriptions = $request->street_descriptions;
                $item->notes = $request->notes;
                $item->save();
            }
        }
        return $request->action;

    }

    public function edit_my_address(Request $request)
    {

        $hashedPassword = User::find($id)->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            $users_rules = array(
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password|min:6',
            );
            $users_validation = Validator::make($request->all(), $users_rules);

            if ($users_validation->fails()) {
                return redirect()->back()->withErrors($users_validation)->withInput();
            }
            $user = User::findOrFail($id);
            $user->password = bcrypt($request->password);
            $user->save();


            return redirect()->back()->with('status', __('cp.update'));
        } else {
            return 'password not correct';
        }

    }

    public function my_order()
    {
        $user = Auth('web')->user();

        $items = Order::query()->where(
            'user_id', $user->id
        )->get();

        return view('website.profile.my-order', [
            'user' => $user,
            'items' => $items,
        ]);
    }

    public function order_details($id)
    {
        $item = Order::where('id', $id)->with(['address' ,'items'])->first();
        return view('website.order-details', ['item' => $item]);
    }

    public function edit_address($id)
    {
        if (\request()->ajax()) {
            $data = UserAddress::findOrFail($id);
            return response()->json([
                'result' => $data
            ]);
        }
    }

    public function delete_address($id)
    {
        if (\request()->ajax()) {
            $data = UserAddress::findOrFail($id);
            return response()->json([
                'result' => $data
            ]);
        }
    }
}
