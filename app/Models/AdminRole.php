<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Admin;

class AdminRole extends Model
{

    // use SoftDeletes;
    protected $table = 'admin_roles';

    protected $fillable = ['role_id' ];
    protected $hidden = ['updated_at', 'deleted_at'];
 
 
     public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');

    }
     public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');

    }

}
