<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'option1',
        'option2',
        'option3', // ví dụ: Size, Color, Material
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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($variation) {
            if (empty($variation->sku)) {
                $variation->sku = $variation->generateVariationSku();
            }
        });

        static::updating(function ($variation) {
            if ($variation->isDirty(['option1', 'option2'])) {
                $variation->sku = $variation->generateVariationSku();
            }
        });
    }

    public function generateVariationSku()
    {
        $product = $this->product;

        // Lấy SKU gốc của sản phẩm
        $baseSku = $product->sku; // Ví dụ: ROLEX-DJ41-BLUE-001

        // Mã biến thể
        $opt1 = $this->option1 ? strtoupper(Str::slug($this->option1)) : 'NA';
        $opt1 = substr(preg_replace('/[^A-Z0-9]/', '', $opt1), 0, 4);

        $opt2 = $this->option2 ? strtoupper(Str::slug($this->option2)) : 'NA';
        $opt2 = substr(preg_replace('/[^A-Z0-9]/', '', $opt2), 0, 4);

        // Đếm biến thể trùng option để thêm số thứ tự
        $count = static::where('product_id', $product->id)
            ->where('option1', $this->option1)
            ->where('option2', $this->option2)
            ->count();

        $suffix = $count > 0 ? '-' . ($count + 1) : '';

        return $baseSku . '-' . $opt1 . '-' . $opt2 . $suffix;
    }
}
