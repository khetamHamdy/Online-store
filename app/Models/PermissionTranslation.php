<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionTranslation extends Model
{
    use SoftDeletes;
    protected $table='permission_translations';
    protected $fillable = ['name','permission_id','locale'];
}
