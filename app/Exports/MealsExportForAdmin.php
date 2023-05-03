<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\Meal;
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


class MealsExportForAdmin implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison
{
    use Exportable;

    public function  __construct($request)
    {
        $this->request = $request;

    }

    public function array(): array
    {

        $meals = Meal::filter()->orderBy('id')->get();

        foreach($meals as $one){
            $items[] = [
                $one->id,
                @$one->title,
                @$one->user->name,
                @$one->category->name? : __('cp.un_assigned'),
                @$one->price,
                @$one->status,
                $one->created_at->format('Y-m-d')
            ];
        }

        return $items;
    }

    public function headings() :array
    {
        return ["id",__('cp.title') ,__('cp.provider') ,__('cp.category') ,__('cp.price')
            ,__('cp.status'),__('cp.created')];

    }
}



