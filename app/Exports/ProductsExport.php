<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class ProductsExport implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison
{
    use Exportable;

    public function  __construct($request)
    {
        $this->request = $request;

    }

    public function array(): array
    {

         $products=Product::get();

        foreach($products as $one){

            $items[] = [
                @$one->id,
                @$one->title,
                @$one->description,
                @$one->price,
                @$one->quantity,
                @$one->category->name,
                @$one->status,
                @$one->created_at,
            ];
        }

        return $items;
    }

    public function headings() :array
    {
        return ["id","name" ,"description" ,"price","quantity","category","status","created_at"];
    }
}
