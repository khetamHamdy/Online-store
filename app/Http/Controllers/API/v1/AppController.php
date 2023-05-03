<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\CartExtra;
use App\Models\CartOption;
use App\Models\Extra;
use App\Models\Bill;
use App\Models\Cuisine;
use App\Models\Day;
use App\Models\Gift;
use App\Models\JoinRequest;
use App\Models\Meal;
use App\Models\Setting;
use App\Models\Subadmin;
use App\Models\Subscription;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Time;
use App\Models\User;
use App\Models\UserSearch;
use App\Models\Wallet;
use App\Models\Banner;
use App\Models\Token;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;


class AppController extends Controller
{

    protected $paginateTotal = '';
    protected $settings = '';

    public function __construct()
    {
        $this->settings = Setting::orderBy('id', 'desc')->first();
        $this->paginateTotal = $this->settings->paginateTotal;
    }


    public function home(Request $request){
        $validator = Validator::make($request->all(), [
            'zoom' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n",$validator-> messages()-> all()) ]);
        }

        $items = Subadmin::filter()->where('status','active');
        
        
        $ddistance=0;
        if($request->zoom<=10){
            $ddistance=100;
        }else if($request->zoom<=11) {
            $ddistance=80;
        }else if($request->zoom<=12){
            $ddistance=60;
        }else if($request->zoom<=13){
            $ddistance=30;
        }else if($request->zoom<=14){
            $ddistance=10;
        }else if($request->zoom<=15){
            $ddistance=8;
        }else if($request->zoom<=16){
            $ddistance=5;

        }else {
            $ddistance=1;
        }

        $items=$items->where('status','active')->select(\DB::raw("*,( 6371 * acos( cos( radians($request->latitude) ) * cos( radians( latitude ) ) * cos( radians(longitude) - radians($request->longitude)) + sin(radians($request->latitude)) * sin( radians(latitude)))) AS distance"))->having("distance", "<", $ddistance)->orderBy('id','desc')->take(10)->get()->makeHidden('user_name');
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items]);
    }

    public function search(Request $request){
        
        $check = UserSearch::where(function($q)use($request){
            $q->where('user_id',auth('api')->id())->orWhere('fcm_token',$request->header('fcmToken'));
        })->first();
        
        
        if($request->name !='' && !$check){
            $search = new UserSearch();
            if (auth('api')->check()){
                $search->user_id = auth('api')->id();
            }
            $search->fcm_token = $request->header('fcmToken');
            $search->name = $request->name;
            $search->save();
        }
        
        $items =  $items->with(['cuisines.cuisine'])->filter()->where('status','active')->paginate(30)->items();

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items , 'is_more'=>count($items)==30]);
    }


    public function getMySearches(Request $request){
        $items = UserSearch::where(function ($q) use ($request) {
            $q->where('fcm_token', $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->orderByDesc('id')->limit(5)->get();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items , 'is_more'=>count($items)==30]);
    }

    public function deleteMySearches(Request $request){
        UserSearch::where(function ($q) use ($request) {
            $q->where('fcm_token', $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->delete();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }


    public function restaurantDetails(Request $request , $id)
    {
        $item = Subadmin::with(['images','categories'])->with('business_hours')->where('id', $id)->first()->makeHidden('cuisines');
        $cuisinesIds = @$item->cuisines->pluck('cuisine_id')->toArray();
        $cuisines = Cuisine::whereIn('id',$cuisinesIds)->get();
        $item['restaurant_cuisines'] = $cuisines;
        $item['total'] = $this->calculate($request,$id)['sub_total'];
        $item['count'] = $this->calculate($request,$id)['count'];
        
//        $timesIds = $item->times->pluck('id')->toArray();
//        $times = Day::with('times')->get();
//        $item['times'] = $times;

        if ($item) {
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'item' => $item]);
        }else{
            $message = __('api.whoops');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
    }

    public function restaurantMeals(Request $request , $id)
    {
        $items = Meal::where('user_id',$id)->where('status','active')->orderBy('sort_order')->filter()->paginate($this->settings->paginateTotal)->items();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items , 'is_more'=>count($items) == $this->settings->paginateTotal]);
    }


    public function mealDetails(Request $request , $id)
    {
        $item = Meal::with('options.option_values.option_value')->with(['extras','images'])->where('id',$id)->first();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'item' => $item]);
    }



    public function contactUs(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:8|max:14',
            'message' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n",$validator-> messages()-> all()) ]);
        }

        $item = new Contact();
        $item->name = $request->get('name');
        $item->email = $request->get('email');
        $item->mobile = $request->get('mobile');
        $item->message = $request->get('message');

        $item->save();

        $message = __('api.done_successfully');
        return response()->json(['status' => true,  'message' => $message,   ]);

    }


    public function JoinUs(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:8|max:14',
            'description' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n",$validator-> messages()-> all()) ]);
        }

        $item = new JoinRequest();
        $item->name = $request->get('name');
        $item->email = $request->get('email');
        $item->mobile = $request->get('mobile');
        $item->description = $request->get('description');

        $item->save();

        $message = __('api.done_successfully');
        return response()->json(['status' => true,  'message' => $message,   ]);

    }

    public function getSetting()
    {
        $settings = Setting::query()->first();
        $settings['banner'] = Banner::where('status','active')->inRandomOrder()->first();
        $settings['pages'] = Page::get();
        $settings['cuisines'] = Cuisine::get();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'settings' => $settings]);
    }


    public function calculate(Request $request ,$id)
    {
        $items = Cart::whereHas('meal',function($query)use($id){
            $query->where('user_id',$id);
        })->where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->get();

        $sub_total = 0;

        foreach ($items as $one) {
            if (@$one->meal->price_offer > 0) {
                $sub_total += (@$one->meal->price_offer * $one->quantity);
            } else {
                $sub_total += (@$one->meal->price * $one->quantity);
            }
            foreach ($one->options as $option) {
                $sub_total += @$option->option->price;
            }
            foreach ($one->extras as $extra) {
                if (@$extra->extra->price) {
                    $sub_total += (@$extra->extra->price * @$extra->quantity);
                }
            }
        }
        $data = [
            'sub_total' => $sub_total,
            'count' => count($items),
        ];

        return $data;

    }


}
