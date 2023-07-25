<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    public $fillable = ['user_id', 'add_name', 'country_id', 'city_id', 'street_descriptions',
        'notes'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault('not available ');
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault('not available Country');
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault(['price' => 'not available ']);
    }
}
