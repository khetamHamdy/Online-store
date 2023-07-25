<?php

namespace App\Exports;

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


class OrderExport implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison
{
    use Exportable;

    public function  __construct($request)
    {
        $this->request = $request;

    }

    public function array(): array
    {

         $orders=Order::get();

        foreach($orders as $one){

            $items[] = [
                $one->id,
                $one->customer_name,
                $one->customer_email,
                $one->customer_mobile,
                $one->total,
                $one->payment_method==1?__('cp.online'):__('cp.cache_on_pickup'),
                $one->status,
                $one->created_at,
            ];
        }

        return $items;
    }

    public function headings() :array
    {
        return ["id","customer_name" ,"customer_email","customer_mobile",
       "total","payment_method","status","created_at"];

    }
}
