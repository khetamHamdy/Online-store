<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = ['image', 'link', 'status'];

    public $translatedAttributes = ['title', 'description'];

    public function getImageAttribute($value)
    {
        if (!is_null($value) && isset($value) && $value!=''){
            return url('uploads/sliders/' . $value) ;
        }else{
            return url('uploads/images/d.jpeg');
        }
    }

    public function scopeStatus($query)
    {
        $query->where('status', '=', 'active');
    }
}
