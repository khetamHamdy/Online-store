<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   use Translatable;
    public $translatedAttributes = ['working_times','address','key_words'];
    public $guarded = [];
    protected $hidden=['translations','updated_at','deleted_at'];

    public function getCategoriesCoverAttribute($logo)
    {
        return !is_null($logo)?url('uploads/settings/'.$logo):null;
    }


    public function getProjectsCoverAttribute($logo)
    {
        return !is_null($logo)?url('uploads/settings/'.$logo):null;
    }


    public function getContactCoverAttribute($logo)
    {
        return !is_null($logo)?url('uploads/settings/'.$logo):null;
    }


    public function getLoginImageAttribute($logo)
    {
        return !is_null($logo)?url('uploads/settings/'.$logo):null;
    }
    public function getFaviconAttribute($favicon)
    {
        return !is_null($favicon)?url('uploads/settings/'.$favicon):null;
    }



}
