<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Products;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()
        // ->count(10)
        //     ->state(new Sequence(
        //         ['roles' => json_encode(['admin'])],
        //         ['roles' => json_encode(['customer'])]
        //     ))
        // ->create();
        // User::factory()->create([
        //     'name' => fake()->name(),
        //     'email' => 'test@example.com',
        // ]);
        // Tạo admin trước (để đăng nhập ngay)
    User::factory()->admin()->create([
        'email' => 'admin@timekeeper.com',
        'password' => bcrypt('admin123'),
    ]);

    // Tạo 50 khách hàng
    User::factory(50)->create();
// === 1. Tạo 10 danh mục cha (gốc) ===
// 1. TẠT HẾT EVENT & MODEL OBSERVER ĐI – QUAN TRỌNG NHẤT!!!
        Category::flushEventListeners();

        // 2. Tạo 10 danh mục cha (gốc) – lúc này chúng đã có _lft, _rgt ngay lập tức
        $roots = Category::factory(10)->create();

        // // 3. Dùng mỗi root đã có _lft/_rgt → appendToNode() 100% an toàn
        // foreach ($roots as $root) {
        //     Category::factory(rand(3, 7))->create()->each(function ($child) use ($root) {
        //         $child->appendToNode($root)->saveQuietly(); // saveQuietly để không trigger event
        //     });
        // }

        // // 4. Thêm cấp 3 (nếu muốn)
        // Category::whereNotNull('parent_id')
        //     ->inRandomOrder()
        //     ->take(12)
        //     ->get()
        //     ->each(function ($parent) {
        //         if (rand(0, 1)) {
        //             Category::factory(rand(2, 4))->create()->each(fn($gc) =>
        //                 $gc->appendToNode($parent)->saveQuietly()
        //             );
        //         }
        //     });

        // 3. Tạo sản phẩm
        Product::factory(80)->create();

        // 4. Tạo sản phẩm có biến thể
        Product::factory(40)->withVariations(6)->create();
        // Tạo user mẫu nếu chưa có
        User::factory(20)->create();

    // Tạo sản phẩm + variation trước (nếu chưa có)
    // if (Product::count() < 50) {
    //     Category::factory(10)->create();
    //     // \App\Models\Brand::factory(10)->create();
    //     \App\Models\Product::factory(80)->create();
    //     \App\Models\Product::factory(40)->withVariations(6)->create();
    // }

    // TẠO 100 ĐƠN HÀNG MẪU SIÊU THỰC TẾ
    // database/seeders/DatabaseSeeder.php
    Order::factory(100)->create()->each(function ($order) {
        OrderItem::factory(rand(1,5))->create(['order_id' => $order->id]);
        $order->subtotal = $order->items->sum('total');
        $order->total = $order->subtotal + $order->shipping_fee - $order->discount;
        $order->saveQuietly();
    });
    }
}
