<?php

namespace App\Traits;
use Image;
use Illuminate\Support\Facades\File;

trait imageTrait
{
    public function storeImage($image , $fileName , $oldImageName = null , $width = 512 , $height = null ){
        if ($image) {
            $extention = $image->getClientOriginalExtension();
            $image_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
           if (! File::exists("uploads/$fileName")) {
                    File::makeDirectory("uploads/$fileName");
                }
            if($height == null){
                Image::make($image)->resize($width , $height ,function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/$fileName/$image_name");
                if($oldImageName != null){
                    unlink('uploads/'.$fileName.'/'.$oldImageName);
                }
            }else{
                Image::make($image)->resize($width , $height)->save("uploads/$fileName/$image_name");
                if($oldImageName != null){
                    unlink('uploads/'.$fileName.'/'.$oldImageName);
                }
            }
            return $image_name;
        }else{
            return '';
        }
    }
}