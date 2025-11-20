<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->words(2, true);

        return [
            'name'       => ucfirst($name),
            'slug'       => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'image'      => $this->faker->imageUrl(400, 400, 'category'),
            'sort_order' => $this->faker->numberBetween(0, 100),
            'is_active'  => $this->faker->boolean(95),
            'parent_id'  => null,    // luôn null ở đây
            '_lft'       => 0,
            '_rgt'       => 0,
        ];
    }

    // Cách an toàn nhất: tạo xong rồi mới gắn cha
    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            // 40% danh mục sẽ là con (chỉ chạy khi đã có ít nhất 2 node)
            if (Category::count() > 3 && $this->faker->boolean(40)) {
                $parent = Category::where('id', '!=', $category->id)
                    ->inRandomOrder()
                    ->first();

                if ($parent && $parent->_lft && $parent->_rgt) {
                    $category->appendToNode($parent)->saveQuietly(['timestamps' => false]);
                }
            }
        });
    }
}
