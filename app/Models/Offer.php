<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public $table="offers";
    public $fillable = ['price', 'end_offer', 'start_offer', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
