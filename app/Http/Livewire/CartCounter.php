<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CartCounter extends Component
{
    public $show = false;

    public $count = 0;

    protected $listeners = ['updateCartCount' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->count = $this->getCount();

        if ($this->count > 0) {
            $this->show = true;
        } else {
            $this->show = false;
        }
    }

    public function getCount()
    {
        $cartCount = \App\Models\Cart::where(['cookie_id' => Cookie::get('cart_cookie_id')])->count();
        return $cartCount;
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
