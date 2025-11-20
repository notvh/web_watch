<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;

   protected $fillable = ['name', 'slug', 'image', 'parent_id', 'sort_order', 'is_active'];

    protected $guarded = ['_lft', '_rgt'];

 
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // ==================== RELATIONSHIPS ====================
    public function products()
    {
        return $descendants = $this->descendants()->pluck('id')->push($this->id);
        return Product::whereIn('category_id', $descendants);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // ==================== SCOPES ====================
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ==================== ACCESSORS ====================
    public function getUrlAttribute()
    {
        return route('categories.show', $this->slug);
    }

    public function getBreadcrumbAttribute()
    {
        return $this->ancestorsAndSelf()->pluck('name')->implode(' > ');
    }

    public function getProductCountAttribute()
    {
        return $this->products()->active()->count();
    }
}
