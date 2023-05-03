<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class OrdersExportForProvider implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison
{
    use Exportable;

    public function  __construct($request)
    {
        $this->request = $request;

    }

    public function array(): array
    {

        $orders=Order::OrderByDesc('id')->where('provider_id',auth('subadmin')->id())->get();

        foreach($orders as $one){
            $items[] = [
                $one->id,
                @$one->customer_name,
                @$one->customer_mobile,
                @$one->customer_email,
                @$one->total,
                $one->payment_method==1?__('cp.online'):__('cp.cache_on_pickup'),
                $one->status_text,
                $one->created_at->format('Y-m-d - h:i A'),

                ];
        }

        return $items;
    }

    public function headings() :array
    {
        return ["id" ,__('cp.customer_name') ,__('cp.customer_mobile')
            ,__('cp.customer_email')  ,__('cp.total_price')  ,__('cp.payment_method')
            ,__('cp.status'),__('cp.created')];

    }
}



