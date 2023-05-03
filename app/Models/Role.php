<?php



namespace App\Models;

use App\User;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model

{
    use Translatable; //SoftDeletes, 
    protected $table = 'roles';
    protected $guarded = [];
    public $translatedAttributes = ['name'];


    public function permissions()
    {
        return $this->hasMany(RolePermission::class,'role_id');
    }
    

}

