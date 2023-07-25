<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $appends = ['id_to_price'];
    protected $fillable = [
        'product_id', 'user_id', 'quantity','price','addition_id','size_id','color_id','cookie_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class )->withDefault([
            'name' => 'Anonymous'
        ]);
    }

    public function getIdToPriceAttribute()
    {
        return ' KWD ' . $this->price;
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['user_name'=>'--']);
    }

    public function color()
    {
        return $this->belongsTo(Color::class)->withDefault(['name'=>'no color avaible']);
    }

    public function size()
    {
        return $this->belongsTo(Size::class)->withDefault(['size'=>'no size avaible']);
    }

    public function addition()
    {
        return $this->belongsTo(Addition::class)->withDefault(['name'=>'no addition avaible']);
    }
}
