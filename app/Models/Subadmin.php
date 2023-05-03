<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Subadmin extends Authenticatable
{
    use Notifiable,HasApiTokens,SoftDeletes,Translatable;

    public $translatedAttributes = ['name','description'];

    protected $hidden = [
        'translations', 'updated_at', 'deleted_at','created_at', 'password', 'remember_token'];
    protected $appends=['url_link'];
    
    public function getUrlLinkAttribute()
    {
          return  url(''.'/'.$this->id.'/'.slugUrl($this->name));
    }
    
    public function getImageAttribute($value)
    {
        if (!is_null($value) && isset($value) && $value!=''){
            return url('uploads/images/subadmins/' . $value) ;
        }else{
            return url('uploads/images/subadmins/defualtUser.png');
        }
    }
    public function meals(){
        return $this->hasMany(Meal::class,'user_id' ,'id');
    }

    public function cuisines(){
        return $this->hasMany(UserCuisines::class,'user_id' ,'id');
    }

    public function business_hours(){
        return $this->hasMany(RestaurantBusinesHour::class,'user_id' ,'id');
    }

    public function provider_orders(){
        return $this->hasMany(Order::class,'provider_id','id')->withTrashed();
    }

    public function images(){
        return $this->hasMany(UserImage::class,'user_id' ,'id');
    }


    public function categories(){
        return $this->hasMany(Category::class,'user_id' ,'id')->orderBy('sort_order');
    }


    public function getTotalSalesAttribute(){
      return  round($this->provider_orders()->sum('total'),2);
    }

    public function getTotalOrdersAttribute(){
      return  $this->provider_orders()->count();
    }

    public function getAvgOrdersAttribute(){
      return  round($this->provider_orders()->average('total'),2);
    }

    public function scopeFilter($query)
    {
        if (request()->has('email')) {
            if (request()->get('email') != null)
                $query->where('email', 'like', '%' . request()->get('email') . '%');
        }
        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->whereTranslationLike('name','%' . request()->get('name') . '%');
        }
        if (request()->has('user_name')) {
            if (request()->get('user_name') != null)
                $query->where('user_name', 'like', '%' . request()->get('user_name') . '%');
        }

        if (request()->has('mobile')) {
            if (request()->get('mobile') != null)
                $query->where('mobile', 'like', '%' . request()->get('mobile') . '%');
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }

        if (request()->has('type')) {
            if (request()->get('type') != null)
                $query->where('type', request()->get('type'));
        }

        if (request()->has('types')) {
            if (request()->get('types') != null){
                $query->whereIn('type', request()->get('types'));
            }
        }
        
        if (request()->has('only_open')) {
            if (request()->get('only_open') != null){
                if (request()->get('only_open') == '1') { // Only Open
                    $query->where('opening_status', '1');
                }
            }
        }
        
        if (request()->has('only_available_pick_up')) {
            if (request()->get('only_available_pick_up') != null){
                if (request()->get('only_available_pick_up') == '1') { // Only Open
                    $query->where('accept_pick_up', '1');
                }
            }
        }
        if (request()->has('cuisines')) {
            if (request()->get('cuisines') != null &&count(request()->get('cuisines')) > 0)
                $query->whereHas('cuisines',function ($q) {
                    $q->whereIn('cuisine_id',  request()->get('cuisines'));
                });
        }

        if (request()->has('id')) {
            if (request()->get('id') != null)
                $query->where('id',  request()->get('id'));
        }


    }

}
