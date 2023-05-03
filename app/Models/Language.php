<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes, Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['lang','flag'];

    public function getFlagAttribute($flag){
        return url($flag);
    }


}
