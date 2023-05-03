<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\JoinRequest;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class JoinRequestExport implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison
{
    use Exportable;

    public function  __construct($request)
    {
        $this->request = $request;

    }

    public function array(): array
    {

        $requests=JoinRequest::get();

        foreach($requests as $one){
            $items[] = [
                $one->id,
                $one->name,
                $one->email,
                $one->mobule,
                $one->description,
                $one->is_read==1?__('cp.seen'):__('cp.pending'),
                $one->created_at,
            ];
        }

        return $items;
    }

    public function headings() :array
    {
        return ["id",__('cp.name') ,__('cp.email'),__('cp.mobile'),__('cp.description'),__('cp.status'),__('cp.created_date')];

    }
}



