<?php

namespace App\Http\Controllers\API\v1;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartExtra;
use App\Models\CartOption;
use App\Models\Extra;
use App\Models\Language;
use App\Models\Meal;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Order;
use App\Models\OrderMeal;
use App\Models\OrderMealExtra;
use App\Models\OrderMealOption;
use App\Models\Page;
use App\Models\PromoCode;
use App\Models\Token;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CartController extends Controller
{

    protected $paginateTotal = '';
    protected $settings = '';

    public function __construct()
    {
        $this->settings = Setting::orderBy('id', 'desc')->first();
        $this->paginateTotal = $this->settings->paginateTotal;
    }

    public function addToCart(Request $request)
    {
        if (!$this->settings->is_allow_buy) {
            $message = __('api.buy_is_not_allow');
            return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
        }

        $validator = Validator::make($request->all(), [
            'meal_id' => 'required',
            'quantity' => 'required',
//            'options_ids' => 'required', //contains -
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $meal = Meal::where('id', $request->meal_id)->first();
        if (!$meal) {
            $message = __('api.meal_not_found');
            return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
        }
        
           if (!@$meal->user->accept_pick_up) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.order_provider_not_accepting_orders')]);
        }
        // start options test

        if ($request->has('options_ids') && Str::endsWith($request->options_ids, '/')) {
            $message = __('api.syntax_error') . ' /';
            return response()->json(['status' => false, 'code' => 403, 'message' => $message]);

        }
        if ($request->has('options_ids') && !str_contains($request->options_ids, '-')) {
            $message = __('api.syntax_error') . ' -';
            return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
        }


        $meal_options_ids = @$meal->options->pluck('id')->toArray();
        $options_ids = [];
        $slots = [];
        if (isset($request->options_ids)) {
            $slots = explode('/', $request->options_ids);
        }
        if (count($slots) > 0) {
            foreach ($slots as $slot) {
                $id = explode('-', $slot)[0];
                $options_ids[] = $id;
            }
        }
        if (array_diff($options_ids, $meal_options_ids) || array_diff($meal_options_ids, $options_ids)) {
//            return $options_ids;
            $message = __('api.options_error');
            return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
        }


        if (isset($request->options_ids)) {
            if ($request->options_ids != null) {
                $arrayIds = explode('/', $request->options_ids);
                foreach ($arrayIds as $one) {
                    $parentId = explode('-', $one)[0];
                    $parent = Option::where('id', $parentId)->first();
                    $childrenIds = explode(',', explode('-', $one)[1]);
                    $children = OptionValue::whereIn('id', $childrenIds)->get();

                    if ($parent->options_type == 1 && count($children) == 0) {
                        $message = __('api.you_must_add_at_least_one_option') . '  ' . $parent->name;
                        return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
                    }
                    if ($parent->selection_type == 0 && count($children) > 1) {
                        $message = __('api.you_cannot_add_more_than_one_option') . '  ' . $parent->name;
                        return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
                    }

                    if ($parent->selection_type == 1 && count($children) < $parent->minimum_value) {
                        $message = __('api.you_must_add_at_least') . ' ' . $parent->minimum_value . ' ' . __('api.in') . '  ' . $parent->name;
                        return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
                    }

                    if ($parent->selection_type == 1 && count($children) > $parent->maximum_value) {
                        $message = __('api.you_cannot_add_more_than') . ' ' . $parent->maximum_value . __('api.in') . '  ' . $parent->name;
                        return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
                    }

                }
            }
        }

//         // end options test

        // start extras test
        if (isset($request->extras)) {
            if ($request->extras != null) {
                foreach ($request->extras as $extra) {
                    $e = Extra::where('id', $extra['id'])->first();
                    if (!$e || $e->meal_id != $request->meal_id) {
                        $message = __('api.error_in_extras');
                        return response()->json(['status' => false, 'code' => 403, 'message' => $message]);
                    }
                }
            }
        }
        // end extras test

         
        
        
        $message = __('api.quantity_changed');
        $test_cart = Cart::where(function ($q) use ($request) {
            $q->where('fcm_token', $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->first();

        if ($test_cart){
            if (@$test_cart->meal->user_id != $meal->user_id) {
                $message = __(@$test_cart->meal->user->name);
                return response()->json(['status' => false, 'code' => 203, 'message' => $message]);
            }
        }


        $meal_id = $request->meal_id;

        $add_carts_before = Cart::where('meal_id', $meal_id)->where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->latest()->get();
        
        $is_same_options = 1;
        $is_same_extras = 1;
        $i = 0;
        $same_extra_cart_id = [];
        $same_option_cart_id = [];
        foreach($add_carts_before as $added_cart){
            $cart_options= [];  // options in cart
            $requst_options= [];  // options in request
            
            $cart_exist_extras= [];  // extras in cart
            $requst_exist_extras= [];  // extras in request
        
        
            // $cart_options[] = $added_cart->options;
               
            
            if (isset($request->options_ids)) {
                if ($request->options_ids != null) {
                    $current_arrayIds = explode('/', $request->options_ids);
                    foreach ($current_arrayIds as $one) {
                        $parentId = explode('-', $one)[0];
                        $childrenIds = explode(',', explode('-', $one)[1]);
                        foreach ($childrenIds as $cId) {
                             $requst_options[] = $cId .','. $parentId;
                        }
                    }
                }
            } 
            
            if (array_diff(json_decode($added_cart->options_cart), $requst_options) || array_diff($requst_options,json_decode($added_cart->options_cart))) {
                $is_same_options = $is_same_options - 1;

                
            }else{
                $same_option_cart_id[] = $added_cart->id;

            }
            $cart_exist_extras[] = $added_cart->extras;
            
           
            if (isset($request->extras)) {
                if ($request->extras != null) {
                    foreach ($request->extras as $extra) {
                        $requst_exist_extras[] = $extra['id'].'-'.  $extra['quantity'];
    
                    }
                }
            }

            $json = json_decode($added_cart->extras_cart);
           
           

            
           
            if ((array_diff($json, $requst_exist_extras))  || (array_diff($requst_exist_extras , $json))) {
                $is_same_extras = $is_same_extras - 1;

            }else{
                
                        $same_extra_cart_id[] = $added_cart->id;

            }
            
            
            
        }
        $intersect = array_intersect($same_option_cart_id , $same_extra_cart_id);
        
        // return count($intersect);
        if(count($intersect) > 0){
            // return $intersect;
            $oldCart =  Cart::where('id' , $intersect[0])->first();
            $oldCart->increment('quantity');
            
        }else{
        $item = new Cart();
        $item->meal_id = $request->meal_id;
        $item->fcm_token =  $request->header('fcmToken');
        
        $new_options = [];
        
        
        if (isset($request->options_ids)) {
                if ($request->options_ids != null) {
                    $request_arrayIds = explode('/', $request->options_ids);
                    foreach ($request_arrayIds as $one) {
                        $requesrParentId = explode('-', $one)[0];
                        $requesrChildrenIds = explode(',', explode('-', $one)[1]);
                        foreach ($requesrChildrenIds as $cId) {
                             $new_options[] = $cId .','. $requesrParentId;
                        }
                    }
                }
            } 
        
        
        //     if (isset($request->options_ids)) {
        //     if ($request->options_ids != null) {
        //         $current_arrayIds = explode('_', $request->options_ids);
        //         foreach ($current_arrayIds as $one) {
        //             $parentId = explode('-', $one)[0];
        //             $childrenIds = explode(',', explode('-', $one)[1]);
        //              $append_chids = '';
        //              foreach($childrenIds as $childId){
        //                     if(end($childrenIds) == $childId){
        //                     $append_chids = $append_chids.$childId;
        //                       }else{
        //                     $append_chids = $append_chids.$childId.',';
                                  
        //                       }
        //              }
                        
                    
        //             $new_options[] = $parentId."-".$append_chids;              
            
        //         }
        //     }
        // }
        $item->options_cart = json_encode($new_options);

        
        // ["4-[\"3\",\"4\"]","3-[\"4\"]"]
        
        
        $new_extras = [];
        $i = 0;
        if($request->extras){
         foreach ($request->extras as $extra) {
                $new_extras[$i] = $extra['id'].'-'.  $extra['quantity'];
                $i++;
        }
        }

        $item->extras_cart = json_encode($new_extras);
        
        
//        if (isset($request->quantity)) {
        $item->quantity = $request->quantity;
//        }
        if (auth('api')->check()) {
            $item->user_id = auth('api')->id();
        }
        $item->save();
        if (isset($request->options_ids)) {
            if ($request->options_ids != null) {
                $current_arrayIds = explode('/', $request->options_ids);
                foreach ($current_arrayIds as $one) {
                    $parentId = explode('-', $one)[0];
                    $childrenIds = explode(',', explode('-', $one)[1]);
                    foreach ($childrenIds as $cId) {
                        $cart_options = new CartOption();
                        $cart_options->cart_id = $item->id;
                        $cart_options->option_value_id = $cId;
                        $cart_options->parent_id = $parentId;
                        $cart_options->save();
                    }
                }
            }
        }

        if (isset($request->extras)) {
            if ($request->extras != null) {
                foreach ($request->extras as $extra) {
                    $cart_extras[] = [
                        'cart_id' => $item->id,
                        'extra_id' => $extra['id'],
                        'quantity' => $extra['quantity'],
                    ];
                }
                CartExtra::insert($cart_extras);
            }
        }
        
        $message = __('api.addNewMeal');
            
        }
           
           
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

    }

    public function removeFromCart(Request $request , $id)
    {
        $item = Cart::where('id', $id)->where(function ($q) use ($request) {
            $q->where('fcm_token', $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->first();
        if ($item) {
            $item->delete();
            CartExtra::where('cart_id', $item->id)->delete();
            CartOption::where('cart_id', $item->id)->delete();
            $message = __('api.ok');
            $sub_total = $this->calculate($request)['sub_total'];
            $total = $this->calculate($request)['total'];
            $discount = $this->calculate($request)['discount'];
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'sub_total' => $sub_total, 'total' => $total, 'discount' => $discount]);
        } else {
            $message = __('api.not_exists');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
    }

    public function changeQuantity(Request $request, $id)
        {
            $item = Cart::where('id', $id)->where(function ($q) use ($request) {
                $q->where('fcm_token', $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
            })->first();
            if ($item) {
                if ($request->type == '1') {
                    $item->increment('quantity');
                } elseif ($request->type == '0') {
                    if ($item->quantity > 0) {
                        $item->decrement('quantity');
                    }
                }
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            }
            $message = __('api.whoops');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }

    public function myCart(Request $request)
    {
        $items = Cart::whereHas('meal')->with(['meal', 'extras.extra', 'options.option'])->where(function ($q) use ($request) {
            $q->where('fcm_token', $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->get();

        $sub_total = $this->calculate($request)['sub_total'];
        $total = $this->calculate($request)['total'];
        $discount = $this->calculate($request)['discount'];

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items, 'sub_total' => $sub_total, 'total' => $total, 'discount' => $discount, 'is_missing' => false]);
    }

    public function startNewOrder(Request $request)
    {
          $items = Cart::where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->get();

        Cart::where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->delete();

        CartExtra::whereIn('cart_id', $items->pluck('id')->toArray())->delete();
        CartOption::where('cart_id', $items->pluck('id')->toArray())->delete();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }

    public function checkPromoCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }

        $check = $this->checkCode($request);
        $data = $this->calculate($request);
        if ($check) {
            $message = __('api.applied_successfully');
            $data['status'] = true;
        } else {
            $message = __('api.wrong_promo_code');
            $data['status'] = false;
        }
        $data['message'] = $message;
        return response()->json($data);
    }

    public function storeOrder(Request $request)
    {
        $roles = [
            'payment_method' => 'required',
        ];
        if (!auth('api')->check()) {
            $roles = [
                'user_name' => 'required',
                'mobile' => 'required|digits:8',
            ];
        }
        $validator = Validator::make($request->all(), $roles);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        if (!auth('api')->check() && $request->payment_method == '2') {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.you_must_login_to_pay_on_pickup')]);
        }

        $items = Cart::where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->get();

        $check_cart = Cart::where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->first();

        if (count($items) == 0) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.cart_is_empty')]);
        }
        if (@$check_cart->meal->user->opening_status == 3) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.provider_is_closed')]);
        }
        if (!@$check_cart->meal->user) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.order_provider_not_exist')]);
        }
        $order = new Order();
        if (auth('api')->check()) {
            $order->user_id = auth('api')->id();
            $order->customer_name = auth('api')->user()->user_name;
            $order->customer_email = auth('api')->user()->email;
            $order->customer_mobile = auth('api')->user()->mobile;
        } else {
            $order->customer_name = $request->user_name;
            $order->customer_email = '';
            $order->customer_mobile = $request->mobile;
        }
        $order->fcm_token =  $request->header('fcmToken');
        $data = $this->calculate($request);
        $order->total = $data['total'];
        $order->sub_total = $data['sub_total'];
        $order->discount = $data['discount'];
        if ($this->checkCode($request)) {
            $check = $this->checkCode($request);
            $order->promo_code_id = $check->id;
            $order->promo_code_name = $check->name;
            $order->promo_code_amount = $check->amount;
            $order->promo_code_type = $check->discount_type;
            $check->increment('count_usage');
            $check->save();
        }
        $order->payment_method = $request->payment_method;
        $order->payment_status = '0';
        $order->order_date = date('Y-m-d');
        $order->status = '1';
        $order->provider_id = @$check_cart->meal->user_id;
        $done = $order->save();
        if ($done) {
            $url = '';
            foreach ($items as $item) {
                $order_meal = new OrderMeal();
                $order_meal->order_id = $order->id;
                $order_meal->meal_id = @$item->meal->id;
                $order_meal->price = @$item->meal->price;
                $order_meal->quantity = @$item->quantity;
                $order_meal->save();
                foreach ($item->options as $opt) {
                    $option = new OrderMealOption();
                    $option->order_meal_id = $order_meal->id;
                    $option->option_id = $opt->option_value_id;
                    $option->price = @$opt->option->price;
                    $option->save();
                }

                foreach ($item->extras as $ext) {
                    $extra = new OrderMealExtra();
                    $extra->order_meal_id = $order_meal->id;
                    $extra->extra_id = $ext->extra_id;
                    $extra->price = @$ext->extra->price;
                    $extra->quantity = @$ext->quantity;
                    $extra->save();
                }
            }

            if ($request->payment_method != 2) {
                $payment = payment($order->total, $order->id, route('checkPayment', ['order_id' => $order->id]), @$order->provider->supplier_code, $request->payment_method );
                $url = @$payment->response->Data->PaymentURL;
                if ($url) {
                    $order->transaction_id = @$payment->response->Data->InvoiceId;
                    $order->payment_json = json_encode(@$payment->response);
                    $order->save();
                }
            }else{
                Cart::where(function ($q) use ($request , $order) {
                    $q->where('fcm_token', $order->fcm_token)->orWhere('user_id', auth('api')->id());
                })->delete();
                CartExtra::whereIn('cart_id', $items->pluck('id')->toArray())->delete();
                CartOption::where('cart_id', $items->pluck('id')->toArray())->delete();
                updateAdminOrdersFirebaseNotification('increment', '1');
                updateProviderOrdersFirebaseNotification('increment', $order->provider_id);

                dispatch(function () use ($request, $order) {
                    $settings = Setting::query()->first();
                    $email_data = array(
                        'from' => env('MAIL_FROM_ADDRESS'),
                        'fromName' => env('MAIL_FROM_NAME'),
                        'to' => [@$order->customer_email]); //
                    try {
                        $subject = 'شكرا لطلبك الجديد';
                        $blade_data = array(
                            'subject' => $subject,
                            'settings' => $settings,
                            'order' => $order,
                        );
                        if (@$order->customer_email != '') {
                            Mail::send(['html' => 'emails.order_to_user'], $blade_data, function ($message) use ($email_data, $subject) {
                                $message->to($email_data['to'])
                                    ->subject($subject)
                                    ->replyTo($email_data['from'], $email_data['fromName'])
                                    ->from($email_data['from'], $email_data['fromName']);
                            });
                        }
                    } catch (Exception $e) {
                        return 66;
                    }
                })->afterResponse();
            }

             return response()->json(['status' => true, 'code' => 200,
                'message' => __('api.ok'),'url'=>$url, 'order_id' => $order->id]);

        } else {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.whoops')]);
        }
    }


    public function checkPayment(Request $request, $order_id)
    {
        if ($order_id == "") {
            return redirect(route('failPayment'));
        }
        if ($request->has('paymentId')) {
            $check = validatePayment($request->paymentId);
            if ($check->status) {
                if ($check->response->Data && $check->response->Data->InvoiceStatus === "Paid") {
                    $order = Order::findOrFail($order_id);
                    if ($order) {
                        $order->payment_status = 1;
                        $order->payment_check_response = json_encode($check->response);
                        $order->payment_id = $request->paymentId;
                        $order->save();

                         $items = Cart::where(function ($q) use ($request , $order) {
                            $q->where('fcm_token', $order->fcm_token)->orWhere('user_id', auth('api')->id());
                        })->get();

                        CartExtra::whereIn('cart_id', $items->pluck('id')->toArray())->delete();
                        CartOption::where('cart_id', $items->pluck('id')->toArray())->delete();

                        Cart::where(function ($q) use ($request , $order) {
                            $q->where('fcm_token', $order->fcm_token)->orWhere('user_id', auth('api')->id());
                        })->delete();

                        updateAdminOrdersFirebaseNotification('increment', '1');
                        updateProviderOrdersFirebaseNotification('increment', $order->provider_id);

                        dispatch(function () use ($request, $order) {
                            $settings = Setting::query()->first();
                            $email_data = array(
                                'from' => env('MAIL_FROM_ADDRESS'),
                                'fromName' => env('MAIL_FROM_NAME'),
                                'to' => [@$order->customer_email]); //
                            try {
                                $subject = 'شكرا لطلبك الجديد';
                                $blade_data = array(
                                    'subject' => $subject,
                                    'settings' => $settings,
                                    'order' => $order,
                                );
                                if (@$order->customer_email != '') {
                                    Mail::send(['html' => 'emails.order_to_user'], $blade_data, function ($message) use ($email_data, $subject) {
                                        $message->to($email_data['to'])
                                            ->subject($subject)
                                            ->replyTo($email_data['from'], $email_data['fromName'])
                                            ->from($email_data['from'], $email_data['fromName']);
                                    });
                                }
                            } catch (Exception $e) {
                                return 66;
                            }
                        })->afterResponse();

                        return redirect()->route('successPayment', $order->id);
                    }
                    return redirect()->route('failPayment');
                }
                return redirect()->route('failPayment');
            }
            return redirect()->route('failPayment');
        }
        return redirect()->route('failPayment');
    }

  public function myOrders(Request $request)
    {
        // $items = Order::where('user_id', auth('api')->id())->with(['meals.meal', 'meals.options.option', 'meals.extras.extra'])->orderByDesc('id')->paginate($this->settings->paginateTotal)->items();
        $items = Order::where('user_id', auth('api')->id())->where(function($q){
            $q->where(['payment_method'=>'1','payment_status'=>'1' ])->orWhere('payment_method','2');
        })->with(['provider.cuisines.cuisine'])->orderByDesc('id')->paginate($this->settings->paginateTotal)->items();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items, 'is_more' => count($items) == $this->settings->paginateTotal]);
    }

    public function orderDetails($id)
    {
        $item = Order::where('id', $id)->with(['provider', 'meals.options.option', 'meals.meal', 'meals.extras.extra'])->first();
        if (!$item) {
            return response()->json(['status' => false, 'code' => 200, 'message' => __('api.order_not_found')]);
        }
        // $orderMeals = array();

        // foreach ($item->meals as $one) {
        //     $orderMeal = $one;
        //     $meal = $one->meal;
        //     $optionsIds = $one->options->pluck('option_id')->toArray();
        //     $extrasIds = $one->extras->pluck('extra_id')->toArray();
        //     $meal['options'] = OptionValue::whereIn('id', $optionsIds)->get();
        //     $meal['extras'] = Extra::whereIn('id', $extrasIds)->get(); 
        //     $orderMeal['meal'] = $meal;
        //     $orderMeals[] = $orderMeal;
        // }
        // $item['orderMeals'] = $orderMeals;
        return response()->json(['status' => true, 'code' => 200,
            'message' => __('api.ok'), 'item' => $item]);
    }


    public function reOrder(Request $request)
    {
        $roles = [
            'order_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $roles);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }

        $check = Order::where('id', $request->order_id)->first();
        if (!$check) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.order_not_found')]);
        }

        if (($check->user_id != auth('api')->id() && $check->fcm_token !=  $request->header('fcmToken'))) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.this_order_not_for_you')]);
        }
        if (!$check->provider) {
            return response()->json(['status' => false, 'code' => 201,
                'message' => __('api.order_provider_not_exist')]);
        }
        if (@$check->provider->opening_status == '2' || $check->provider->opening_status == '3') {
            return response()->json(['status' => false, 'code' => 201,
                'message' => __('api.order_provider_not_open')]);
        }
        if (!@$check->provider->accept_pick_up) {
            return response()->json(['status' => false, 'code' => 201,
                'message' => __('api.order_provider_not_accepting_orders')]);
        }

        $orderMeals = OrderMeal::where('order_id', $check->id)->get();
        $is_missing = false;
        foreach ($orderMeals as $one) {
            if (@$one->meal->status == 'active') {

                $check_cart = Cart::where('meal_id', @$one->meal->id)->where(function ($q) use ($request) {
                    $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
                })->first();
                if (!$check_cart) {

                    $newCart = new Cart();
                    $newCart->meal_id = $one->meal_id;
                    $newCart->fcm_token = $check->fcm_token;
                    $newCart->quantity = $one->quantity;
                    if (auth('api')->check()) {
                        $newCart->user_id = auth('api')->id();
                    }
                    $newCart->save();
                    foreach ($one->options as $option) {
                        if (isset($option->option)) {
                            $cart_options = new CartOption();
                            $cart_options->cart_id = $newCart->id;
                            $cart_options->option_value_id = $option->option_id;
                            $cart_options->parent_id = $option->parent_id;
                            $cart_options->save();
                        } else {
                            $is_missing = true;
                        }
                    }

                    foreach ($one->extras as $extra) {
                        if (isset($extra->extra)) {
                            $cart_extras[] = [
                                'cart_id' => $newCart->id,
                                'extra_id' => @$extra->extra->id,
                                'quantity' => $extra->quantity,
                            ];
                        } else {
                            $is_missing = true;
                        }
                    }
                    CartExtra::insert($cart_extras);

                }


            } else {
                $is_missing = true;
            }


        }
        return response()->json(['status' => true, 'code' => 200,
            'message' => __('api.ok'), 'is_missing' => $is_missing]);

    }

    public function calculate(Request $request)
    {
        $items = Cart::where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->get();

        $sub_total = 0;
        $discount = 0;
        $total = 0;
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
        if (isset($request->code)) {
            $check = $this->checkCode($request);
            if ($check) {
                if ($check->discount_type == 1) { // fixed amount
                    $discount = $sub_total - $check->amount;
                } elseif ($check->discount_type == 0) { // percentage
                    $discount = ($sub_total * $check->amount) / 100;
                }
            }
        }
        $total = $sub_total - $discount;
        $data = [
            'sub_total' => $sub_total,
            'discount' => $discount,
            'total' => $total,
        ];

        return $data;

    }

    public function checkCode(Request $request)
    {
        $item = Cart::whereHas('meal')->where(function ($q) use ($request) {
            $q->where('fcm_token',  $request->header('fcmToken'))->orWhere('user_id', auth('api')->id());
        })->first();
        $user_id = @$item->meal->user_id;

        $check = PromoCode::where('name', $request->code)->where('status', 'active')->
        where(function ($query) use ($user_id) {
            $query->whereHas('users', function ($mQuery) use ($user_id) {
                $mQuery->where('user_id', $user_id);
            })->orWhere('user_id', '0');
        })->where(function ($q) {
            $q->whereColumn('max_usage', '>', 'count_usage')->orWhereNull('max_usage');
        })->where('end_date', '>=', Date::now())->first();
        return $check;
    }
    
}
