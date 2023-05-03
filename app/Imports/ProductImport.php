<?php

namespace App\Imports;

use App\User;
use App\Models\Product;
use App\Models\ProductCatecory;
use App\Models\Attachment;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Language;
use Illuminate\Support\Str;

class ProductImport implements ToModel ,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Product|null
     */
    public function model(array $row)
    {
        $locales = Language::all()->pluck('lang');
        
             
        
      //  dd($row['price'] );
      
        $item=Product::where('barcode',$row['barcode'])->first();
        if($item){
          //$price = ($row['price'] != '') ? $row['price'] : $item->price;   
            
                $item->price = ($row['price'] != '') ? $row['price'] : $item->price;  
                $item->category_id =($row['category_id'] != '') ? $row['category_id'] : $item->category_id;
                $item->sub_category_id =($row['sub_category_id'] != '') ? $row['sub_category_id'] : $item->sub_category_id;  
                $item->barcode =($row['barcode'] != '') ? $row['barcode'] : $item->barcode;  
                $item->unit =($row['unit'] != '') ? $row['unit'] : $item->unit;  
                $item->units_counter =($row['units_counter'] != '') ? $row['units_counter'] : $item->units_counter; 
                $item->calories =($row['calories'] != '') ? $row['calories'] : $item->calories; 
                $item->image=($row['image'] != '') ? $row['image'] : $item->image; 

                         foreach ($locales as $locale)
                    {
                        if($row['name_'. $locale] != ''){
                             $item->translateOrNew($locale)->name = $row['name_'. $locale] ?? null;
                        }
                        if($row['description_'. $locale] != ''){
                             $item->translateOrNew($locale)->description = $row['description_'. $locale] ?? null;
                        }
                        if($row['keywords_'. $locale] != ''){
                             $item->translateOrNew($locale)->brand = $row['brand_'. $locale] ?? null;
                        }

                    }
                    
                    $item->save();
            return;
            
        }


        
        $product= new Product(); 
        $product->price = $row['price'] ?? null;
        $product->category_id =$row['category_id'] ?? null;
        $product->sub_category_id =$row['sub_category_id'] ?? null;
        $product->barcode =$row['barcode'] ?? null;
        $product->owner =0;
        $product->unit =$row['unit'] ?? null;
        $product->calories =$row['calories'] ?? null;
        if($row['units_counter'] !=''){
           $product->units_counter =$row['units_counter'] ?? null; 
        }else{
            $product->units_counter =1; 
        }
        $product->image=$row['image'] ?? null;
        
        foreach ($locales as $locale)
        {
            $product->translateOrNew($locale)->name = $row['name_'. $locale] ?? null;
            $product->translateOrNew($locale)->brand = $row['brand_'. $locale] ?? null;
            $product->translateOrNew($locale)->description = $row['description_'. $locale] ?? null;
        }

        $product->save();
    
        if($row['extra_images'] != null) {
            $images= explode(',',$row['extra_images']);
            foreach($images as $id => $item){
                    $items[] = [
                        'product_id' => $product->id,
                        'image' => $item,   
                
                    ];       
           
            }
            Attachment::insert($items);
            }                
               

        
         
        

       
        return;
    }
}
