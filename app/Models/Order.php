<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ['payment_status', 'address_id', 'total', 'payment_method', 'ProductsTotal',
        'discount', 'DeliveryCharges', 'order_date', 'customer_mobile',
        'customer_email', 'customer_name',
        'cookie_id', 'shipping_extraDescreption', 'shipping_deliveryMobileNumber', 'shipping_area', 'shipping_street',
        'shipping_houseNumber', 'shipping_block', 'user_id', 'address_id'
    ];

    protected $hidden = ['updated_at', 'deleted_at', 'payment_json', 'payment_check_response'];
    protected $appends = ['id_to_show'];

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }



    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->using(OrderItems::class)
            ->as('items');
    }

    public function getIdToShowAttribute()
    {
        return '#YM' . $this->id;
    }

    public function promo_code()
    {
        return $this->belongsTo(PromoCode::class);
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

    public function getStatusBadgeAttribute()
    {
        if ($this->status == '1') {
            return 'primary';
        } else if ($this->status == '2') {
            return 'info';
        } else if ($this->status == '3') {
            return 'success';
        } else if ($this->status == '4') {
            return 'warning';
        } else if ($this->status == '5') {
            return 'danger';
        } else {
            return 'success';
        }
    }

    public function scopeFilter($query)
    {
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }
        if (request()->has('id')) {
            if (request()->get('id') != null)
                $query->where('id', request()->get('id'));
        }
        if (request()->has('payment_method')) {
            if (request()->get('payment_method') != null)
                $query->where('payment_method', request()->get('payment_method'));
        }

        if (request()->has('customer_name')) {
            if (request()->get('customer_name') != null)
                $query->where(function ($q) {
                    $q->where('customer_name', 'like', '%' . request()->get('customer_name') . '%');
                });
        }
        if (request()->has('customer_mobile')) {
            if (request()->get('customer_mobile') != null)
                $query->where(function ($q) {
                    $q->where('customer_mobile', 'like', '%' . request()->get('customer_mobile') . '%');
                });
        }
        if (request()->has('customer_email')) {
            if (request()->get('customer_email') != null)
                $query->where(function ($q) {
                    $q->where('customer_email', 'like', '%' . request()->get('customer_email') . '%');
                });
        }

        if (request()->has('providerIds')) {
            if (request()->get('providerIds') != null && count(request()->get('providerIds')) > 0)
                $query->whereIn('provider_id', request()->get('providerIds'));
        }

        if (request()->has('from')) {
            if (request()->get('from') != null)
                $query->where('created_at', '>=', request()->get('from'));
        }

        if (request()->has('to')) {
            if (request()->get('to') != null)
                $query->where('created_at', '<=', request()->get('to'));
        }


    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }


}
