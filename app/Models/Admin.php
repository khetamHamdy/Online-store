<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'image','type'];


        protected $appends = [
        'admin_type'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
    ];


    public function getImageAttribute($value)
    {
        return !is_null($value) ? url('uploads/images/users/' . $value) : url('uploads/images/users/defualtUser.jpg');
    }
    public function getImageProfileAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return url('uploads/images/users/' . $value);
            } else {
                return $value;
            }
        } else {
            return url('uploads/images/users/defualtUser.jpg');
        }
    }


    public function getAdminTypeAttribute($value)
    {
        return "superadmin";
    }


  /*  public function permission()
    {
        return $this->belongsToMany(Permission::class,'user_permissions','user_id','permission_id');
    }*/

    public function permission()
    {
        return $this->hasOne(UserPermission::class,'user_id');
    }

    public function scopeFilter($query)
    {
        if (request()->has('email')) {
            if (request()->get('email') != null)
                $query->where('email', 'like', '%' . request()->get('email') . '%');
        }
        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->where('name', 'like', '%' . request()->get('name') . '%');
        }

        if (request()->has('mobile')) {
            if (request()->get('mobile') != null)
                $query->where('mobile', 'like', '%' . request()->get('mobile') . '%');
        }



    }


    public function roles()
    {
        return $this->hasMany(AdminRole::class,'admin_id');
    }

}
