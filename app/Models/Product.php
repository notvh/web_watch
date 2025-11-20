<?php

namespace App\Models;

use App\Models\ProductVariation;
use Database\Factories\ProductFactory;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return ProductFactory::new();
    }
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'brand_id',
        'category_id',
        'price',
        'compare_price',
        'is_active',
        'is_featured',
        'has_variations',
        'stock',
        'sku',
        'images',
        'specifications'
    ];

    protected $casts = [
        'images'        => 'array',
        'specifications' => 'array',
        'is_active'     => 'boolean',
        'is_featured'   => 'boolean',
        'has_variations' => 'boolean',
    ];

    // ==================== RELATIONSHIPS ====================

    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->where('is_active', true);
    }

    public function allVariations()
    {
        return $this->hasMany(ProductVariation::class); // lấy cả biến thể bị tắt
    }

    // Trong file Product.php đã có từ trước, thêm/bổ sung các phần sau:

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Nếu muốn lấy tất cả danh mục cha (breadcrumbs)
    public function categoryAncestors()
    {
        return $this->category ? $this->category->ancestorsAndSelf() : collect();
    }

    // URL sản phẩm
    public function getUrlAttribute()
    {
        return route('products.show', ['category' => $this->category?->slug, 'slug' => $this->slug]);
    }
    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class);
    // }

    // ==================== ACCESSORS & MUTATORS ====================

    // Giá thấp nhất của tất cả variation (nếu có variation)
    protected function lowestPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->has_variations
                ? $this->variations()->min('price')
                : $this->price
        );
    }

    // Giá cao nhất (dùng cho hiển thị khoảng giá: 200.000 - 500.000)
    protected function highestPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->has_variations
                ? $this->variations()->max('price')
                : $this->price
        );
    }

    // Giá so sánh thấp nhất (giá gạch ngang)
    protected function lowestComparePrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->has_variations
                ? $this->variations()->min('compare_price')
                : $this->compare_price
        );
    }

    // Tổng tồn kho thực tế
    protected function totalStock(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->has_variations
                ? $this->variations()->sum('stock')
                : $this->stock
        );
    }

    // Ảnh đầu tiên (thumbnail)
    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->images[0] ?? null
        );
    }

    // Kiểm tra còn hàng không
    public function inStock(): bool
    {
        return $this->total_stock > 0;
    }

    // Scope: chỉ lấy sản phẩm đang active và có hàng
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where(function ($q) {
            $q->where('has_variations', false)->where('stock', '>', 0)
                ->orWhereHas('variations', fn($v) => $v->where('stock', '>', 0));
        });
    }
}
