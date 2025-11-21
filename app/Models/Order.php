<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'province',
        'district',
        'ward',
        'subtotal',
        'shipping_fee',
        'discount',
        'total',
        'status',
        'note',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Tự động tạo mã đơn DH-00001, DH-00002...
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->code)) {
                // Dùng afterCommit để chắc chắn insert đã xong
                $order->code = $order->generateOrderCode();
            }
        });
    }

    public function generateOrderCode()
    {
        $prefix = 'DH-' . now()->format('Ym'); // DH-202511
        $last = static::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->max('id');
        $number = $last ? $last + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'completed' => 'completed',
            'processing', 'shipping' => 'processing',
            'canceled', 'refunded' => 'pending',
            default => 'pending',
        };
    }
    // app/Models/Order.php – thêm accessor
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending'     => 'bg-orange-600 text-white',
            'confirmed'   => 'bg-blue-600 text-white',
            'processing'  => 'bg-purple-600 text-white',
            'shipping'    => 'bg-indigo-600 text-white',
            'completed'   => 'bg-green-600 text-white',
            'canceled'    => 'bg-red-600 text-white',
            'refunded'    => 'bg-gray-600 text-white',
            default       => 'bg-gray-500 text-white',
        };
    }
}
