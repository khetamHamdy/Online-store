<?php



namespace App\Models;



use App\User;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class Permission extends Model

{

    use SoftDeletes, Translatable;

    protected $table = 'permissions';

    protected $guarded = [];

    public $translatedAttributes = ['name'];





}

