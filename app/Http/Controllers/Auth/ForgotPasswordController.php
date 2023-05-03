<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Psy\Util\Json;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

// protected $constant;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct(ConstantController $constant)
    // {
    //     $this->constant = $constant;
    //     $this->middleware('guest');
    // }
 

    protected function forgotPasswordForm()
    {
        return view('website.user.forgotPassword');
    }

    function mainResponse($status, $message, $data, $code, $key,$validator)
    {
        try {
            $result['status'] = $status;
            $result['code'] = $code;
            $result['message'] = $message;

            if ($validator->fails()) {
                $errors = $validator->errors();
                $errors = $errors->toArray();
                $message = '';
                foreach ($errors as $key => $value) {
                    $message .= $value[0] . ',';
                }
                $result['message'] = $message;
                return response()->json($result, $code);
            }elseif (!is_null($data)) {


                if ($status) {
                    if ($data != null && array_key_exists('data', $data)) {
                        $result[$key] = $data['data'];
                    } else {
                        $result[$key] = $data;
                    }
                } else {
                    $result[$key] = $data;
                }
            }
            return response()->json($result, $code);
        } catch (Exception $ex) {
            return response()->json([
                'line' => $ex->getLine(),
                'message' => $ex->getMessage(),
                'getFile' => $ex->getFile(),
                'getTrace' => $ex->getTrace(),
                'getTraceAsString' => $ex->getTraceAsString(),
            ], $code);
        }
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function forgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            // $errors = $validator->errors();
            // $errors = $errors->toArray();
            // $message = '';
            // foreach ($errors as $key => $value) {
            //     $message .= $value[0] . ',';
            // }
            return mainResponse(false, '' , null, 203, 'items',$validator);
        }
        if ($request->get('email')) { // accept Json header
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                $message = (app()->getLocale() == 'ar') ? ' البريد الإلكتروني المدخل غير مسجل  ' : 'We cant find a user with that e-mail address';
                return mainResponse(false, $message, null, 203, 'items',$validator);
            }
            $token = $this->broker()->createToken($user);
            //$url = url('/password/reset/' . $token);
            $user->notify(new ResetPassword($token));
            $message = (app()->getLocale() == 'ar') ? 'تم إرسال رابط تعيين كلمة المرور للبريد الإلكتروني المدخل' : 'Reset password link have been sent to your email address';

            return mainResponse(true, $message, null, 200, 'items',$validator);
        }else{
            $message = (app()->getLocale() == 'ar') ? ' البريد الإلكتروني المدخل غير مسجل  ' : 'We cant find a user with that e-mail address';
            return mainResponse(false, $message, null, 203, 'items',$validator);
        }
    }



    public function sendResetLinkEmail(Request $request)
    { 
       
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:filter',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }
        
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $message = 'The email not found';
            return response()->json(['status' => false, 'code' => 400,'message' => $message ]);
        }
  
        $token = $this->broker()->createToken($user); 
        $user->notify(new ResetPassword($token));
        $message = __('website.ResetPasswordEmailSent');
 
        if ($user) {
                return response()->json(['status' => true, 'code' => 200,'message'=>$message]);
          
        } else {
            return redirect()->back()->withErrors([ __('site.Whoops')])->withInput();
        }
    }
    
}