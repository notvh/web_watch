<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $product->has_variations
            ? $product->variations->random()->price
            : $product->price;

        $variation = null;
        if ($product->has_variations) {
            $v = $product->variations->random();
            $variation = "Màu: {$v->option1}, Size: {$v->option2}";
        }

        return [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
            'variation' => $variation,
            'image' => $product->images[0] ?? null,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $price * $quantity,
        ];
    }
}
