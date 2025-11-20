<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Các thuộc tính biến thể (ví dụ: Size, Color, v.v.)
            $table->string('option1')->nullable(); // ví dụ: "M", "Red"
            $table->string('option2')->nullable(); // ví dụ: "Cotton"
            $table->string('option3')->nullable(); // ít dùng nhưng để dự phòng

            $table->string('sku')->unique();                    // SKU riêng của variation
            $table->decimal('price', 16, 2);
            $table->decimal('compare_price', 16, 2)->nullable();
            $table->integer('stock')->default(0);

            $table->string('image')->nullable(); // ảnh riêng của variation (nếu có)

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Index để tìm kiếm nhanh
            $table->index(['product_id', 'is_active']);
            $table->unique(['product_id', 'option1', 'option2', 'option3']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
