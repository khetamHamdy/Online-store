<?php

namespace App\Http\Livewire;

use App\Events\OrderCreated;
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
use Kreait\Firebase\Auth;
use Livewire\Component;

class CheckoutUser extends Component
{
    use LivewireAlert;

    public $DeliveryCharges;
    public $discount_price;
    protected $products_price;
    public $price;
    protected $total_price_quantity;
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
    public $UserAddress;
    public $city_id;

    public function mount()
    {
        $this->order = Order::where(['cookie_id' => $this->getOrderCookieId(), 'user_id' => Auth('web')->id()])->first() ?? 0;
        $this->payment_method = $this->order->payment_method ?? null;
        $this->address_id = $this->order->address_id ?? null;
    }

    public function render()
    {

        $this->UserAddress = UserAddress::where('id', $this->address_id)->first();
        $this->DeliveryCharges = $this->UserAddress->city->price ?? 0;

        $this->items = Cart::with('product')
            ->where('cookie_id', Cookie::get('cart_cookie_id'))->latest()
            ->get();

        $this->price = $this->items->sum(function ($item) {
            return $item->quantity * ($item->price + $item->addition->price);
        });

        $this->total = $this->price + $this->DeliveryCharges;

        $user = Auth('web')->user();
        $countries = Country::where('status', 'active')->latest()->get();
        $citys = City::where('status', 'active')->latest()->get();

        return view('livewire.checkout-user', [
            'user' => $user,
            'countries' => $countries,
            'citys' => $citys,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'order' => $this->order,
            'products_price' => $this->products_price,
        ]);

    }

    public function store_order()
    {
        $this->items = Cart::with('product')
            ->where('cookie_id', Cookie::get('cart_cookie_id'))->latest()
            ->get();
        $this->validate([
            'address_id' => 'required',
            'payment_method' => 'required',
        ]);

        $order = Order::UpdateOrCreate(
            [
                'cookie_id' => $this->getOrderCookieId(),
                'user_id' => Auth('web')->id(),
                'total' => $this->total,
            ],
            [
                'customer_name' => Auth('web')->user()->user_name,
                'customer_email' => Auth('web')->user()->email,
                'customer_mobile' => Auth('web')->user()->mobile,
                'order_date' => Carbon::now(),
                'DeliveryCharges' => $this->DeliveryCharges,
                'ProductsTotal' => $this->price,
                'payment_method' => $this->payment_method,
                'payment_status' => 0,
                'shipping_block' => $this->UserAddress->add_name,
                'shipping_houseNumber' => $this->UserAddress->house_number,
                'shipping_street' => $this->UserAddress->street_descriptions,
                'shipping_area' => $this->UserAddress->city_id,
                'shipping_deliveryMobileNumber' => $this->UserAddress->delivery_mobile_number,
                'shipping_extraDescreption' => $this->UserAddress->notes,
                'address_id' => $this->address_id,
            ]
        );

        $orderUpdate = Order::find($order->id);
        if ($orderUpdate->discount_price) {
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
        // event('order.created', [$cart, Auth::user()]);

        event(new OrderCreated($order));
        if ($order) {
        Cart::with('product')->where('cookie_id', Cookie::get('cart_cookie_id'))->delete();

            if ($order->payment_method == 2) {
                return $this->confirm('سيتم التواصل معك', [
                    'showCancelButton' => false,
                    'confirmButtonText' => 'Done',
                    'icon' => 'success',
                ]);
            } else {
                return redirect()->to('/order/' . $order->cookie_id . '/pay');
            }

        }
    }

    public function store_promoCode()
    {
        $this->validate([
            'promo_name' => 'string|max:255',
        ]);

        $Promo_code = PromoCode::where('promo_code_name', $this->promo_name)->first();

        if (!$Promo_code && $this->order->promo_code_id == null) {
            return $this->confirm('Invalid Promo Code!', [
                'showCancelButton' => false,
                'confirmButtonText' => 'OK',
                'icon' => 'error',
            ]);
        }

        if ($Promo_code->expires_at && now()->gt($Promo_code->expires_at)) {
            return $this->confirm('Expired promo code !', [
                'showCancelButton' => false,
                'confirmButtonText' => 'OK',
                'icon' => 'error',
            ]);
        }

        $discount = $Promo_code->discount;

        $discountedPrice = $this->total - ($this->total * $discount / 100);

        $this->order->total = $discountedPrice + $this->DeliveryCharges;
        $this->order->discount_price = $discountedPrice;
        $this->order->promo_code_id = $Promo_code->id;
        $this->order->save();

        $this->render();

        if ($discountedPrice) {
            return $this->confirm('APPLIED SUCCESSFULLY!', [
                'showCancelButton' => false,
                'confirmButtonText' => 'OK',
                'icon' => 'success',
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
