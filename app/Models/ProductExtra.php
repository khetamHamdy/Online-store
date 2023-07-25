<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductExtra extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $table = 'product_extras';

    protected $fillable = ['product_id', 'extra_id'];


}
