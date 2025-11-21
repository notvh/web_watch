<?php

namespace App\Models;


use Illuminate\Support\Str;
use App\Models\ProductVariation;
use Database\Factories\ProductFactory;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes;
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
    protected static function boot()
    {
        parent::boot();

        // Tạo SKU cho sản phẩm chính (khi không có biến thể hoặc sản phẩm gốc)
        static::creating(function ($product) {
            if (empty($product->sku)) {
                $product->sku = static::generateSku($product);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                // || $product->isDirty('brand_id')
                $product->sku = static::generateSku($product);
            }
        });
    }

    /**
     * Sinh SKU cho sản phẩm chính
     * Ví dụ: ROLEX-DJ41-BLUE-001
     */
    public static function generateSku($product)
    {
        $brandCode = optional($product->brand)->slug ?? 'BRAND';
        $brandCode = strtoupper(substr($brandCode, 0, 4)); // ROLE, OMEG, SEIK...

        $nameCode = strtoupper(Str::slug($product->name));
        $nameCode = preg_replace('/[^A-Z0-9]/', '', $nameCode);
        $nameCode = substr($nameCode, 0, 10); // Giới hạn độ dài

        $latest = static::where('sku', 'like', "{$brandCode}-{$nameCode}%")
            ->latest('id')
            ->first();

        $number = 1;
        if ($latest) {
            preg_match('/-(\d+)$/', $latest->sku, $matches);
            $number = isset($matches[1]) ? (int)$matches[1] + 1 : 1;
        }

        return sprintf('%s-%s-%03d', $brandCode, $nameCode, $number);
    }
    // Quan hệ xóa theo (khi xóa sản phẩm → xóa luôn biến thể)
    protected static function booted()
    {
        static::deleting(function ($product) {
            // Xóa ảnh trên storage
            foreach ($product->images ?? [] as $image) {
                Storage::disk('public')->delete($image);
            }

            // Xóa ảnh biến thể
            $product->variations()
            // ->withTrashed()
            ->each(function ($variation) {
                if ($variation->image) {
                    Storage::disk('public')->delete($variation->image);
                }
            });

            // Xóa biến thể (soft delete)
            $product->variations()->delete();
        });

        // Khi khôi phục sản phẩm → khôi phục luôn biến thể
        // static::restoring(function ($product) {
        //     $product->variations()->restore();
        // });
    }
}
