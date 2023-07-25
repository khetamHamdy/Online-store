<?php



namespace App\Models;



use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class Page extends Model

{

    use SoftDeletes, Translatable;



    public $translatedAttributes = ['title', 'description','get_familiarize','our_vision','our_mission'];
    protected $hidden=['translations','updated_at','deleted_at'];



    protected $fillable = ['image'];


    public function getImageAttribute($image)
    {
        return !is_null($image) ? url('uploads/pages/' . $image) : url('uploads/images/d.png');
    }

    public function getSecondImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }

    public function getVisionImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }

    public function getMissionImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }
    public function getFamiliarizeImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/pages/' . $value) : url('uploads/images/d.png');
    }


}

