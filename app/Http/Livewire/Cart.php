<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Cart extends Component
{
    use WithPagination;

    public $carts;
    public $new_qty;
    public $item_id;

    public function mount()
    {
        $this->carts = \App\Models\Cart::with('product')
            ->where('cookie_id', Cookie::get('cart_cookie_id'))->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.cart', [
            'carts' => $this->carts,
            'total' => ' KWD ' . $this->totalAll(),
        ]);
    }


    public function delete($id)
    {
        \App\Models\Cart::where('id', $id)->where('cookie_id', Cookie::get('cart_cookie_id'))->delete();
        $this->mount();
        $this->render();
    }


    public function update_quantity($id)
    {
        $item = \App\Models\Cart::where('id', $id)->where('cookie_id', Cookie::get('cart_cookie_id'))->first();
        $item->quantity = $this->new_qty;
        $item->save();
        $this->mount();
        $this->render();
    }

    public function totalAll()
    {
        $items = $this->carts;
        return $items->sum(function ($item) {
            return $item->quantity * ($item->price + $item->addition->price);
        });
        $this->render();
    }

    public function total($id)
    {
        $item = \App\Models\Cart::where('id', $id)
            ->where('cookie_id', Cookie::get('cart_cookie_id'))
            ->first();
        return ' KWD ' . $item->quantity * ($item->price + $item->addition->price);
    }

    public function getGreeting($name)
    {
        return 'Hello ' . $name;
    }

    protected function getCookieId()
    {
        $id = Cookie::get('cart_cookie_id');
        if (!$id) {
            $id = Str::uuid();
            Cookie::queue('cart_cookie_id', $id, 60 * 24 * 30);
        }

        return $id;
    }


}
