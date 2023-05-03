<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'offer_price'=>$this->discount_price,
            'image'=>$this->image,
//            'color'=>[
//                $this->colors->id,
//                $this->colors->name,],
//            'size'=>[
//                $this->size->id,
//                $this->size->name,],
        ];
    }
}
