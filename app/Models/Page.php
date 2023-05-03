<?php



namespace App\Models;



use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class Page extends Model

{

    use SoftDeletes, Translatable;



    public $translatedAttributes = ['title', 'description'];
    protected $hidden=['translations','updated_at','deleted_at'];



    protected $fillable = ['image'];


    public function getImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }

    public function getSecondImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }

    public function getOurVisionImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }

    public function getOurMissionImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }

}

