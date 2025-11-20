<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 500000, 50000000);
        $shipping = $this->faker->randomElement([30000, 40000, 0, 50000]);
        $discount = $this->faker->randomElement([0, 50000, 100000, 200000]);
        $total = $subtotal + $shipping - $discount;

        return [
            'user_id' => User::inRandomOrder()->first() ?? User::factory(),
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->safeEmail,
            'customer_phone' => '0' . $this->faker->randomElement(['3', '5', '7', '8', '9']) . $this->faker->numberBetween(10000000, 99999999),
            'customer_address' => $this->faker->streetAddress,
            'province' => $this->faker->city,
            'district' => $this->faker->citySuffix,
            'ward' => 'Phường ' . $this->faker->numberBetween(1, 20),

            'subtotal' => $subtotal,
            'shipping_fee' => $shipping,
            'discount' => $discount,
            'total' => $total,

            'status' => $this->faker->randomElement([
                'pending', 'confirmed', 'processing', 'shipping', 'completed', 'canceled'
            ]),

            'note' => $this->faker->optional(0.3)->sentence,

            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
