<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Notification;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Token;
use App\Models\Setting;
use App\Models\Language;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Notifications\ResetPassword;



class UserController extends Controller
{
    use SendsPasswordResetEmails;

    protected $paginateTotal = '';
    protected $settings = '';

    public function __construct()
    {
        $this->settings = Setting::orderBy('id', 'desc')->first();
        $this->paginateTotal = $this->settings->paginateTotal;
    }


    public function broker()
    {
        return Password::broker('users');
    }

    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }

    public function signUp(Request $request)
    {
        if (!$this->settings->is_allow_register) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => __('api.sign_up_is_not_allow')]);
        }
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|email:filter|unique:users',
            'mobile' => 'required|digits:8|unique:users',
//            'mobile' => 'required|digits_between:8,12|unique:users',
//            'address' => 'required',
            'password' => 'required|min:6',
//            'type' => 'required',
            'fcm_token' => 'required',
            'device_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }

        $newUser = new User();
        $newUser->user_name = $request->get('user_name');;
        $newUser->mobile = convertAr2En($request->get('mobile'));
        $newUser->email = $request->get('email');
        $newUser->password = bcrypt($request->get('password'));
        $newUser->type = '1';
        $newUser->save();

        if ($newUser) {
            if ($request->has('fcm_token')) {
                Token::updateOrCreate(['device_type' => $request->get('device_type'), 'fcm_token' => $request->get('fcm_token'), 'lang' => app()->getLocale()], ['user_id' => $newUser->id]);
            }

            $user = User::findOrFail($newUser->id);
            Auth::login($user);
            $user['access_token'] = $user->createToken('mobile')->accessToken;

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'user' => $user->makeHidden(['name','image','description','accept_pick_up','branch_name','opening_status','longitude','latitude','type'])]);
        }
        $massege = __('api.whoops');
        return response()->json(['status' => false, 'code' => 200, 'message' => $massege]);
    }

    public function login(Request $request)
    {
        $settings = Setting::first();
        if (!$settings->is_allow_login) {
            $message = __('api.loginStoped');
            return response()->json(['status' => false, 'message' => $message]);
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 200,
                    'message' => implode("\n", $validator->messages()->all())]);
            }

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $conditions = ['email' => $request->email, 'password' => $request->password];
            } else {
                $conditions = ['mobile' => $request->email, 'password' => $request->password];
            }


            if (Auth::once($conditions)) {

                $user = Auth::user();
                if ($user->is_deleted == '1'){
                    $message = (app()->getLocale() == "ar") ? 'الحساب غير موجود' : 'The account is not found';
                    return response()->json(['status' => false, 'code' => 210, 'message' =>
                        $message]);
                }
                if ($user->type != '1'){
                    $message = (app()->getLocale() == "ar") ? 'يرجى تسجيل الدخول بحساب مستخدم صحيح' : 'please login by correct account';
                    return response()->json(['status' => false, 'code' => 210, 'message' =>
                        $message]);
                }
                if ($user->status == 'not_active') {
                    $message = (app()->getLocale() == "ar") ? 'الحساب غير مفعل , يرجى التواصل مع الادارة' : 'The account you are trying to login has been deactivated. Please contact our customer care';
                    return response()->json(['status' => false, 'code' => 210, 'message' =>
                        $message]);
                } else {
                    if ($request->has('fcm_token')) {
                        Token::updateOrCreate(['device_type' => $request->get('device_type'), 'fcm_token' => $request->get('fcm_token'), 'lang' => app()->getLocale()]
                            , ['user_id' => $user->id]);
                    }
                    $user['access_token'] = $user->createToken('mobile')->accessToken;
                    $message = __('api.ok');
                    return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'item' => $user->makeHidden(['name','image','description','accept_pick_up','branch_name','opening_status','longitude','latitude','type'])]);
                }
            } else {

                $message = __('api.wrongLoginConditions');
                return response()->json(['status' => false, 'code' => 200, 'message' => $message]);

            }
        }
    }

    public function logout(Request $request)
    {
        $user_id = auth('api')->id();

        if ($request->has('fcm_token')) {
            Token::where('fcm_token', $request->get('fcm_token'))->delete();
        }
        if (auth('api')->user()->token()->revoke()) {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 200,
                'message' => $message]);
        } else {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 202,
                'message' => $message]);
        }
    }

    public function myProfile()
    {
        $user_id = auth('api')->id();
        $item = User::query()->findOrFail($user_id);
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200,
            'message' => $message, 'item' => $item->makeHidden(['name','image','description','accept_pick_up','branch_name','opening_status','longitude','latitude','type'])]);
    }

    public function editUserProfile(Request $request)
    {

        $user = auth('api')->user();
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'mobile' => 'required|digits:8|unique:users,mobile,' . $user->id,
//            'mobile' => 'required|digits_between:8,12|unique:users,mobile,' . $user->id,
//            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }

        $user_name = ($request->has('user_name')) ? $request->get('user_name') : $user->user_name;
//        $email = ($request->has('email')) ? $request->get('email') : $user->email;
        $mobile = (convertAr2En($request->get('mobile'))) ? $request->get('mobile') : $user->mobile;

        $user->user_name = $user_name;
        $user->mobile = $mobile;
//        $user->email = $email;


        $user->save();

        if ($user) {

            if ($request->has('fcm_token')) {
                Token::updateOrCreate(['device_type' => $request->get('device_type'), 'fcm_token' => $request->get('fcm_token')], ['user_id' => $user->id]);
            }
            $user = User::query()->findOrFail($user->id);
            $user['access_token'] = $user->createToken('mobile')->accessToken;

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'user' => $user->makeHidden(['name','image','description','accept_pick_up','branch_name','opening_status','longitude','latitude','type'])]);
        } else {
            $message = __('api.not_edit');
            return response()->json(['status' => false, 'code' => 200,
                'message' => $message, 'validator' => $validator]);
        }
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $user = auth('api')->user();

        if (!Hash::check($request->get('old_password'), $user->password)) {
            $message = __('api.wrong_old_password'); //wrong old
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }

        $user->password = bcrypt($request->get('password'));

        if ($user->save()) {
            $user->refresh();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
        $message = __('api.whoops');
        return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }

    public function updateMyLanguage(Request $request)
    {
        $rules = [
            'fcm_token' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }

        $done = Token::where('fcm_token', $request->get('fcm_token'))->update(['lang' => $request->get('lang')]);
        if ($done) {
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        } else {
            $message = __('api.whoops');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
    }

    public function changeNotificationStatus(){
        $user = User::where('id',auth('api')->id())->first();
        if($user->notifications=='1'){
            $user->notifications='0';
        }else{
            $user->notifications='1';
        }
        $user->save();
        $item=User::where('id',auth('api')->id())->first();

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'item' => $item->makeHidden(['name','image','description','accept_pick_up','branch_name','opening_status','longitude','latitude','type'])]);
    }

    public function deleteMyAccount(Request $request){
        $item = User::where('id',\auth('api')->id())->first();
        $item->status = 'not_active';
        $item->is_deleted = '1';
        $item->save();
        auth('api')->user()->token()->revoke();
        if ($request->header('fcmToken')) {
            Token::where('fcm_token', $request->header('fcmToken'))->delete();
        }
        $message = __('ap.deleted_successfully');
        return response()->json(['status' => true, 'code' => 200,
        'message' => $message]);
    }


    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $message = 'The email not found';
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
        $token = $this->broker()->createToken($user);
        $url = url('/password/reset/' . $token);
        $user->notify(new ResetPassword($token));
        $message = __('api.You_will_receive_email');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }

    public function myNotifications(Request $request)
    {
        $fcm_token = $request->header('user-fcm_token');
        $data = Notification::where('user_id', auth('api')->id())->orWhere('fcm_token',$fcm_token)->orWhere('user_id','-1')->orderBy('id', 'desc')->paginate($this->paginateTotal)->items();
        $is_more = ($this->paginateTotal > count($data)) ? 'no' : 'yes';
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data, 'is_more' => $is_more]);
    }



}
