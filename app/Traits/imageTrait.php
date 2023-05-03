<?php


namespace App\Traits;
use Intervention\Image\Facades\Image;

trait imageTrait
{
    public function storeImage($image , $fileName , $oldImageName = null , $width = 512 , $height = null ){
        if ($image) {
            $extention = $image->getClientOriginalExtension();
            $image_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            if($height == null){
                Image::make($image)->resize($width , $height ,function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/$fileName/$image_name");
                if($oldImageName != null){
                    unlink('uploads/images/'.$fileName.'/'.$oldImageName);
                }
            }else{
                Image::make($image)->resize($width , $height)->save("uploads/$fileName/$image_name");
            }
            return $image_name;
        }else{
            return '';
        }
    }
}
