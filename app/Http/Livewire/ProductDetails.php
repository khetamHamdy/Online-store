<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use App\Models\Product;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductDetails extends Component
{
    use LivewireAlert;

    public $item;
    public $color_id;
    public $size_id;
    public $addition_id;
    public $quantity = 1;
    protected $price_cart;


    public function mount($id)
    {
        $this->item = Product::with(['productImages', 'additions', 'sizes', 'colors'])->where('id', (int)$id)->first();

    }

    public function render()
    {

        return view('livewire.product-details', ['item' => $this->item]);
    }


    public function AddToCart()
    {

        if ($this->item->required_addition == 'on') {
            $this->validate([
                'addition_id' => 'required'
            ]);
        }
        if ($this->item->has_size == 'on') {
            $this->validate([
                'size_id' => 'required'
            ]);
        }
        if ($this->item->has_color == 'on') {
            $this->validate([
                'color_id' => 'required'
            ]);
        }

        $offer = Offer::where('product_id', '=', $this->item->id)->first();

        if ($offer) {
            $this->price_cart = $offer->discount;
        } else {
            $this->price_cart = $this->item->price;
        }

        $cart = \App\Models\Cart::UpdateOrCreate([
            'product_id' => $this->item->id,
            'color_id' => $this->color_id,
            'size_id' => $this->size_id,
            'addition_id' => $this->addition_id,
            'cookie_id' => $this->getCookieId(),
            'user_id' => Auth('web')->id() ?? 'null'
        ], [
            'quantity' => $this->quantity,
            'price' => $this->price_cart
        ]);

        $this->emit('updateCartCount');
        if ($cart) {
            $this->emit('updateCartCount');
            return $this->confirm('Cart successfully  Added 😍', [
                'showCancelButton' => false,
                'confirmButtonText' => 'Done',
                'icon' => 'success'
            ]);

        }
        return $this->confirm('Cart Error 😪', [
            'showCancelButton' => false,
            'confirmButtonText' => 'Done',
            'icon' => 'error'
        ]);
//            if ($item) {
//                $this->dispatchBrowserEvent('swal', [
//                    'title' => 'Feedback Saved',
//                    'timer' => 3000,
//                    'icon' => 'success',
//                    'toast' => true,
//                    'position' => 'top-right'
//                ]);
//            } else {
//                $this->dispatchBrowserEvent('swal', ['title' => 'hello22 from Livewire']);
//
//            }


    }

    public function increas()
    {
        $this->quantity++;
    }

    public function decreas()
    {
        $this->quantity--;
    }

    protected function getCookieId()
    {
        $id = Cookie::get('cart_cookie_id');
        $user = Auth('web')->user();
        if (!$id && !$user) {
            $id = Str::uuid();
            Cookie::queue('cart_cookie_id', $id, 60 * 24 * 30);
        }

        return $id;
    }
}
