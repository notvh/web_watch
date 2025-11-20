<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // hoặc Hash::make('password')
            'phone' => '0' . fake()->randomElement(['3', '5', '7', '8', '9']) . fake()->numberBetween(10000000, 99999999),
            'role' => fake()->randomElement(['customer', 'customer', 'customer', 'staff']), // 75% customer
            'is_active' => true,
            'address' => fake()->streetAddress,
            'province' => fake()->city,
            'district' => 'Quận ' . fake()->numberBetween(1, 12),
            'ward' => 'Phường ' . fake()->numberBetween(1, 20),
            'remember_token' => Str::random(10),
        ];
    }

    // Tạo admin mẫu
    public function admin(): static
    {
        return $this->state(fn() => [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}
