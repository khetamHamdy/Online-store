<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class RolePermission extends Model
{

    // use SoftDeletes;
    protected $table = 'role_permissions';

    protected $fillable = ['role_id' ];
    protected $hidden = ['updated_at', 'deleted_at'];
 
 
     public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');

    }
     public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');

    }

}
