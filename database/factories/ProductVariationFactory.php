<?php

namespace Database\Factories;

use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariationFactory extends Factory
{
    protected $model = ProductVariation::class;

    public function definition(): array
    {
        $basePrice = $this->faker->numberBetween(150000, 3000000);
        $colors = ['Đen', 'Trắng', 'Xám', 'Đỏ', 'Xanh Navy', 'Be', 'Hồng'];
        $sizes  = ['S', 'M', 'L', 'XL', 'XXL'];

        return [
            'option1'        => $this->faker->randomElement($colors), // Color
            'option2'        => $this->faker->randomElement($sizes),  // Size
            'option3'        => null,
            'sku'            => 'VAR-' . strtoupper($this->faker->lexify('????')) . $this->faker->numberBetween(100, 999),
            'price'          => $basePrice,
            'compare_price'  => $this->faker->boolean(35) ? $basePrice + $this->faker->numberBetween(100000, 800000) : null,
            'stock'          => $this->faker->numberBetween(0, 150),
            'image'          => $this->faker->boolean(60) ? $this->faker->imageUrl(800, 800, 'fashion') : null,
            'is_active'      => $this->faker->boolean(90),
        ];
    }
}
