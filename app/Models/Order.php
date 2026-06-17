<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'schedule_id',
        'order_number',
        'user_id',
        'orderDate',
        'customer_name',
        'phone',
        'email',
        'address',
        'gender',
        'service_id',
        'product_id',
        'quantity',
        'price',
        'advance_price_id',
        'payment_method',
        'total_price',
        'discount',
        'subtotal',
        'service_provider',
        'status',
        'otp',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $date = now()->format('ymd'); // Get the current date (YYMMDD)
            $lastOrder = self::where('order_number', 'like', "A{$date}-%")
                ->orderBy('order_number', 'desc')
                ->first();

            $nextNumber = $lastOrder ? (intval(substr($lastOrder->order_number, -3)) + 1) : 1;
            $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            $order->order_number = "A{$date}-{$formattedNumber}";
        });
    }

    public function schedule()
    {
        return $this->belongsTo(TimeSlot::class, 'schedule_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function provider()
    {
        return $this->belongsTo(Professional::class, 'service_provider');
    }

    public function subServices()
    {
        return $this->hasManyThrough(SubService::class, OrderItem::class, 'order_id', 'id', 'id', 'service_id');
    }

    public function products()
    {
        return $this->belongsTo(SubService::class, 'product_id', 'id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function appsUsers()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'id');
    }

    public function advancePrice()
    {
        return $this->belongsTo(advancePrice::class, 'advance_price_id', 'id');
    }

    public function orderCancel()
    {
        return $this->hasOne(OrderCancel::class, 'order_id');
    }
}
