<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Token extends Model
{
     use SoftDeletes;
	 public $table = 'tokens'; 

	  protected $fillable = ['user_id','device_type','fcm_token','accept' , 'lang'];
	  protected $hidden = ['updated_at','deleted_at'];

}
