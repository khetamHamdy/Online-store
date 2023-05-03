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


class OrdersReportForAdmin implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison
{
    use Exportable;

    public function  __construct($request)
    {
        $this->request = $request;

    }

    public function array(): array
    {
        $orders=Order::filter()->where('status','4')->orderByDesc('id')->get();
        foreach($orders as $one){
            $items[] = [
                $one->id,
                @$one->provider->name,
                $one->total,
            ];
        }
        return $items;
    }

    public function headings() :array
    {
        return ["id",__('cp.vendor') ,__('cp.amount')];

    }
}



