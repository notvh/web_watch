<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'option1', 'option2', 'option3', // ví dụ: Size, Color, Material
        'sku',
        'price',
        'compare_price',
        'stock',
        'image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
        'compare_price' => 'decimal:2',
    ];

    // ==================== RELATIONSHIPS ====================

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ==================== ACCESSORS ====================

    // Hiển thị tên biến thể đẹp (VD: "Đỏ - M - Cotton")
    public function getNameAttribute()
    {
        $options = collect([$this->option1, $this->option2, $this->option3])
            ->filter()
            ->implode(' - ');

        return $options ?: 'Default';
    }

    // Ảnh của variation (nếu có), nếu không thì lấy ảnh đầu của product
    public function getDisplayImageAttribute()
    {
        return $this->image ?: ($this->product->images[0] ?? null);
    }

    // Kiểm tra còn hàng
    public function inStock(): bool
    {
        return $this->stock > 0;
    }
}
