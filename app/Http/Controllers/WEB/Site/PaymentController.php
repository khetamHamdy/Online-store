<?php

namespace App\Http\Controllers\WEB\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;


class PaymentController extends Controller
{

    public function redirectToPayment($token)
    {
        $item = Order::where('cookie_id', $token)->first();
        if (!$item) {
            abort(404);
        }

        return view('website.payment', [
            'item' => $item,
            'token' => $token,
        ]);
    }


    public function postPayment(Request $request, $token)
    {

        $STRIPE_PUB_KEY = env('STRIPE_PUBLISHABLE_KEY');
        $STRIPE_SECRET_KEY = env('STRIPE_SECRET_KEY');

        Stripe\Stripe::setApiKey($STRIPE_SECRET_KEY);

        $item = Order::where('cookie_id', $token)->first();

        if ($item->type == 1) {
            $type = 'SIM';
        } else {
            $type = 'Packge';
        }
        $name = 'Type : ' . $type . '  Customer Name : ' . $item->customer_name . '  Mobile : ' . $item->customer_mobile .
            '  Email : ' . $item->customer_email;
        $total = $item->total;
        $redirect_url = route('successPayment');
        $redirect_failPayment = route('failPayment');

        try {
            $charge = Stripe\Charge::create(array(
                // 'customer' => $customer->id,
                'source' => $request->stripeToken,
                'amount' => $total * 10,
                'currency' => 'KWD',
                "description" => $name
            ));
            $charge->captured;
            if ($charge->captured == true || $charge->captured == 1) {

                $item->payment_status = 1;
                $item->payment_method = 1;
                $item->save();

                $payment = new Payment();
                $payment->order_id = $item->id;
                $payment->status = 'pending';
                $payment->amount = $charge->amount;
                $payment->currency = $charge->currency;
                $payment->method = 'complete';
                $payment->transaction_id = $charge->id;
                $payment->transaction_data = $charge->description;
                $payment->save();

                if ($payment->method = 'complete') {
                    $items = Cart::where('cookie_id', Cookie::get('cart_cookie_id'))->get();
                    foreach ($items as $item) {
                        $item->delete();
                    }
                }

                return redirect()->route('home')->with('success', 'Added Successfully');

            } else {
                return redirect()->back()->withErrors('pleas chek your card details');
            }

        } catch (\Exception $ex) {
            //return $ex->getMessage();
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return back();
    }

    public function successPayment()
    {
        return route('home');
    }

    public function failPayment()
    {
        return "failPayment";
    }
}
