<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->sentence(4, true);
        $price = $this->faker->numberBetween(100000, 5000000);

        return [
            'name'              => $name,
            'slug'              => Str::slug($name),
            'short_description' => $this->faker->paragraph(2),
            'description'       => $this->faker->paragraphs(4, true),
            'price'             => $price,
            'compare_price'     => $this->faker->boolean(40) ? $price + $this->faker->numberBetween(100000, 1000000) : null,
            'sku'               => 'SP-' . $this->faker->unique()->numberBetween(10000, 99999),
            'stock'             => $this->faker->numberBetween(0, 200),
            'is_active'         => $this->faker->boolean(90),
            'is_featured'       => $this->faker->boolean(20),
            'has_variations'    => false,
            'images'            => [
                $this->faker->imageUrl(800, 800, 'fashion'),
                $this->faker->imageUrl(800, 800, 'fashion'),
                $this->faker->imageUrl(800, 800, 'fashion'),
            ],
            'category_id'       => Category::inRandomOrder()->first()?->id,
            // 'brand_id'          => Brand::inRandomOrder()->first()?->id,
        ];
    }

    // Sản phẩm có biến thể
    public function withVariations(int $count = 6)
    {
        return $this->state(fn() => [
            'has_variations' => true,
            'price'          => null,
            'compare_price'  => null,
            'stock'          => null,
        ])->afterCreating(function (Product $product) use ($count) {
            ProductVariation::factory()
                ->count($count)
                ->create(['product_id' => $product->id]);
        });
    }
}
