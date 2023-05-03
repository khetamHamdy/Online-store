<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCuisines extends Model
{
    use HasFactory;
    
    public function cuisine(){
        return $this->belongsTo(Cuisine::class , 'cuisine_id','id');
    }
    
    
    public function user(){
        return $this->belongsTo(Subadmin::class , 'user_id','id');
    }
    
    
}
