<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\PromoCode;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CheckoutNotAuth extends Component
{

    public $DeliveryCharges;
    protected $products_price;
    public $price;
    protected $user;
    public $address_id;
    public $payment_method;
    public $promo_name;
    public $total;
    public $order;
    protected $items;

    public $fullname;
    public $email;
    public $mobail;
    public $country_id;
    public $street;
    public $house_num;
    public $block;
    public $delivery_mobile;
    public $extra_directions;
    public $priceD;

    use LivewireAlert;

    public function mount()
    {
        $this->order = Order::where(['cookie_id' => $this->getOrderCookieId(), 'user_id' => 0])->first();
        $this->fullname = $this->order->customer_name ?? null;
        $this->email = $this->order->customer_email ?? null;
        $this->mobail = $this->order->customer_mobile ?? null;
        $this->payment_method = $this->order->payment_method ?? null;

        $this->block = $this->order->shipping_block ?? null;
        $this->house_num = $this->order->shipping_houseNumber ?? null;
        $this->street = $this->order->shipping_street ?? null;
        $this->country_id = $this->order->shipping_area ?? null;
        $this->delivery_mobile = $this->order->shipping_deliveryMobileNumber ?? null;
        $this->extra_directions = $this->order->shipping_extraDescreption ?? null;

    }

    public function render()
    {
        $this->priceD = City::where('id', $this->country_id)->first()->price ?? 0;
        $this->DeliveryCharges = $this->priceD ?? 0;


        $this->items = Cart::with('product')
            ->where('cookie_id', Cookie::get('cart_cookie_id'))->latest()
            ->get();

        $this->price = $this->items->sum(function ($item) {
            return $item->quantity * ($item->price + $item->addition->price);
        });

        $this->total = $this->price + $this->DeliveryCharges;

        $countries = City::where('status', 'active')->latest()->get();
        return view('livewire.checkout-not-auth',
            [
                'countries' => $countries,
                'price' => $this->price,
                'products_price' => $this->products_price,
                'order' => $this->order,
            ]);
    }

    public function store_order()
    {
        $this->items = Cart::with('product')
            ->where('cookie_id', Cookie::get('cart_cookie_id'))->latest()
            ->get();

        $this->validate([
            'fullname' => 'required',
            'email' => 'required',
            'mobail' => 'required',
            'country_id' => 'required',
            'block' => 'required',
            'street' => 'required',
            'house_num' => 'required',
            'extra_directions' => 'required',
            'payment_method' => 'required',
        ]);
        $order = Order::UpdateOrCreate(
            [
                'cookie_id' => $this->getOrderCookieId()
            ],
            [
                'customer_name' => $this->fullname,
                'customer_email' => $this->email,
                'customer_mobile' => $this->mobail,
                'order_date' => Carbon::now(),
                'DeliveryCharges' => 0,
                'ProductsTotal' => $this->price,
                'payment_method' => $this->payment_method,
                'total' => $this->total,
                'payment_status' => 0,
                'shipping_block' => $this->block,
                'shipping_houseNumber' => $this->house_num,
                'shipping_street' => $this->street,
                'shipping_area' => $this->country_id,
                'shipping_deliveryMobileNumber' => $this->delivery_mobile,
                'shipping_extraDescreption' => $this->extra_directions,

            ]
        );

        $orderUpdate = Order::find($order->id);
        if ($orderUpdate->discount_price != null) {
            $orderUpdate->total = $orderUpdate->discount_price + $this->DeliveryCharges;
        }
        $orderUpdate->save();

        OrderItems::where('order_id', $order->id)->delete();

        $cart_items = [];
        foreach ($this->items as $one) {
            $cart_items[] = [
                'order_id' => $order->id,
                'product_id' => $one->product_id,
                'quantity' => $one->quantity,
                'price' => $one->product->price,
            ];
        }
        DB::table('order_items')->insert($cart_items);

        if ($order) {
            if ($order->payment_method == 2) {
                return $this->confirm('سيتم التواصل معك', [
                    'showCancelButton' => false,
                    'confirmButtonText' => 'Done',
                    'icon' => 'success'
                ]);
            } else {
                dd('online');
            }

        }


    }

    public function store_promoCode()
    {
        $this->validate([
            'promo_name' => 'string|max:255'
        ]);

        $Promo_code = PromoCode::where('promo_code_name', $this->promo_name)->first();

        if (!$Promo_code) {
            return $this->confirm('Invalid Promo Code!', [
                'showCancelButton' => false,
                'confirmButtonText' => 'OK',
                'icon' => 'error'
            ]);
        }

        if ($Promo_code->expires_at && now()->gt($Promo_code->expires_at)) {
            return $this->confirm('Expired promo code !', [
                'showCancelButton' => false,
                'confirmButtonText' => 'OK',
                'icon' => 'error'
            ]);
        }

        $discount = $Promo_code->discount;

        $discountedPrice = $this->total - ($this->total * $discount / 100);

        $this->order->total = $discountedPrice + $this->DeliveryCharges;
        $this->order->discount_price = $discountedPrice;
        $this->order->promo_code_id = $Promo_code->id;
        $this->order->save();

        if ($discountedPrice) {
            return $this->confirm('APPLIED SUCCESSFULLY!', [
                'showCancelButton' => false,
                'confirmButtonText' => 'OK',
                'icon' => 'success'
            ]);
        }

    }

    protected function getOrderCookieId()
    {
        $id = Cookie::get('order_cookie_id');
        if (!$id) {
            $id = Str::uuid();
            Cookie::queue('order_cookie_id', $id, 60 * 24 * 30);
        }

        return $id;
    }


}
