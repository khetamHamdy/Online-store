<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $table = 'product_images';

    protected $fillable = ['product_id', 'image'];

    public function getImageAttribute($value)
    {
        if (! is_null($value) && isset($value) && $value != '') {
            return url( $value);
        } else {
            return url('uploads/defaultImages/imageNotAvailable.png');
        }
    }

}
