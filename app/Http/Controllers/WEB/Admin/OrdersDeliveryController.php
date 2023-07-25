<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersDeliveryController extends Controller
{

    public function show(Order $order){
        $delivery = $order->delivery()->select([
            'id',
            'order_id',
            'status',
            DB::raw('ST_X(current_location) AS lat'),
            DB::raw('ST_Y(current_location) AS lng'),
        ])->first();

        return view(
            'admin.orders.delivery', compact('order','delivery')
        );
    }
}
