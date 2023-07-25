<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    use HasFactory;
    protected $fillable = ['related_product_id','product_id'];
    public function product()
{
    return $this->belongsTo(Product::class);
}

public function relatedProduct()
{
    return $this->belongsTo(Product::class, 'related_product_id');
}
}
