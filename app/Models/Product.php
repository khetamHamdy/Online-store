<?php

namespace App\Models;

use App\Helpers\Currency;
use App\Models\Brand;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

    use HasFactory, SoftDeletes, Notifiable, Translatable;

    public $fillable = ['price', 'image', 'user_id', 'count_views', 'type', 'status', 'chat_Count', 'category_id'];
    protected $translatedAttributes = ['title', 'description'];
    protected $appends = ['is_favourite', 'is_offer', 'is_discount', 'id_to_price'];

    protected $hidden = ['updated_at', 'deleted_at'];

//    protected $appends = ['id_to_show'];

//    public function meals()
//    {
//        return $this->hasMany(OrderMeal::class, 'order_id', 'id')->withTrashed();
//    }

    public function getIsFavouriteAttribute()
    {
        $favourite = Cart::where(['user_id' => auth('web')->user()->id ?? 0,
            'product_id' => $this->id])->first();
        if ($favourite) {
            return 1;
        }
        return 0;

    }

    public function getIsOfferAttribute()
    {
        $item = Offer::where([
            'product_id' => $this->id])->first();
        if ($item) {
            return 1;
        }
        return 0;
    }

    public function getIsDiscountAttribute()
    {
        $item = Offer::where([
            'product_id' => $this->id])->first();
        if ($item) {
            return Currency::format($item->discount);
        }
        return 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function getImageAttribute($value)
    {
        if (!is_null($value) && isset($value) && $value != '') {
            return url('uploads/product/' . $value);
        } else {
            return url('uploads/defaultImages/imageNotAvailable.png');
        }
    }

//    public function category()
//    {
//        return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
//    }


    public function getIdToPriceAttribute()
    {
        return Currency::format($this->price);
    }

    public function getStatusTextAttribute()
    {
        if ($this->status == '1') {
            return __('cp.confirmed');
        } else if ($this->status == '2') {
            return __('cp.under_preparing');
        } else if ($this->status == '3') {
            return __('cp.ready_for_pickup');
        } else if ($this->status == '4') {
            return __('cp.completed');
        } else if ($this->status == '5') {
            return __('cp.canceled');
        } else {
            return __('cp.error');
        }
    }

//    public function getStatusBadgeAttribute()
//    {
//        if ($this->status == '1') {
//            return 'primary';
//        } else if ($this->status == '2') {
//            return 'info';
//        } else if ($this->status == '3') {
//            return 'success';
//        } else if ($this->status == '4') {
//            return 'warning';
//        } else if ($this->status == '5') {
//            return 'danger';
//        } else {
//            return 'success';
//        }
//    }

    public function scopeFilter($query)
    {
//        if (request()->has('category_ids')) {
//            if (request()->get('category_ids') != null) {
//                $category_ids = collect(explode(',', request()->get('category_ids')))
//                    ->toArray();
//                return Product::whereHas('categories', function ($query) use ($category_ids) {
//                    $query->whereIn('categories.id', $category_ids);
//                });
//            }
//        }

        if (request()->has('status')) {
            if (request()->get('status') != null) {
                $query->where('status', request()->get('status'));
            }

        }
        if (request()->has('id')) {
            if (request()->get('id') != null) {
                $query->where('id', request()->get('id'));
            }

        }

        if (request()->has('category_id')) {
            if (request()->get('category_id') != null) {
                $query->where('category_id', request()->get('category_id'));
            }

        }

        if (request()->has('price_min')) {
            if (request()->get('price_min') != null) {
                $query->where(function ($q) {
                    $q->where('price', '>=', request()->get('price_min'));
                });
            }

        }

        if (request()->has('price_max')) {
            if (request()->get('price_max') != null) {
                $query->where(function ($q) {
                    $q->where('price', '<=', request()->get('price_max'));
                });
            }

        }
        if (request()->has('name')) {
            if (request()->get('name') != null) {
                $query->whereTranslationLike('title', '%' . request()->get('name') . '%');
            }

        }
        if (request()->has('brand')) {
            if (request()->get('brand') != null) {
                $query->whereTranslationLike('brand', '%' . request()->get('brand') . '%');
            }

        }

        if (request()->has('type')) {
            if (request()->get('type') != null) {
                $query->where('type', request()->get('type'));
            }

        }
    }

    public function scopeSearch($query, $params)
    {
        if ($params) {
            $query->where(function ($q) use ($params) {
                $q->whereTranslationLike('title', '%' . $params . '%');
            });
        }
        return $query;
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->latest('updated_at');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'product_extras');
    }

    public function additions()
    {
        return $this->belongsToMany(Extra::class, 'product_extras');
        // return $this->hasMany(Addition::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault(['name' => '---']);
    }

    public function brand_product()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function relatedProducts()
    {
        return $this->hasMany(RelatedProduct::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
