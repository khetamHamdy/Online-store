<?php
namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Service extends Model
{
    use SoftDeletes, Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name','details'];

    public function getImageAttribute($image)
    {
        return !is_null($image)?url('uploads/services/'.$image):null;
    }

    public function scopeFilter($query)
    {
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }

        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->where(function ($q) {
                    $q->whereTranslationLike('name', '%' . request()->get('name') . '%');
                });
        }
    }
}

