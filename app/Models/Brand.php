<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  use HasFactory,Translatable;
    protected $fillable = ['status'];
    protected $translatedAttributes = ['name'];
    
}
