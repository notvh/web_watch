<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            // Giá gốc và giá bán (nếu tất cả variation có cùng giá thì dùng, còn không để null)
            $table->decimal('price', 16, 2)->nullable();
            $table->decimal('compare_price', 16, 2)->nullable(); // giá gốc/gạch ngang

            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('has_variations')->default(false); // Đánh dấu sản phẩm có biến thể hay không

            $table->integer('stock')->default(0)->nullable(); // Tổng tồn kho (tính từ variations nếu có)
            $table->string('sku')->unique()->nullable();

            $table->json('images')->nullable(); // ["url1", "url2", ...]
            $table->json('specifications')->nullable(); // specs chung của sản phẩm

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('category_id');
            $table->index('brand_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
