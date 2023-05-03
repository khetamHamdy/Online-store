<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admin;
use App\User;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }
    
      public function send_email(Request $request)
    {
    //return 'dfdsv';
    $validator = Validator::make($request->all(), [
            'email'=>'required|email',
        ]);
         if ($validator->fails()) {
         //return 'dsvsv';
            return redirect()->back()->with('error','The email is required');
        
        }
        //$this->validate($request, ['email' => 'required|email']);
        if (!$validator->fails()) { // accept Json header
            $user = Admin::where('email', $request->input('email'))->first();
            if (!$user) {
                return redirect()->back()->with('error','The email not found');
            }
            $token = $this->broker()->createToken($user);
            //$url = url('/password/reset/' . $token);
            //$user->notify(new ResetPassword($token));
            $message_ar = 'تم إرسال رابط تعيين كلمة المرور للبريد الإلكتروني المدخل';
            $message_en = 'Reset password link have been sent to your email address';
            $error=__('errors.reset_pass');
            return redirect()->back()->with('success','Reset password link have been sent to your email address');

        }
    }
}
