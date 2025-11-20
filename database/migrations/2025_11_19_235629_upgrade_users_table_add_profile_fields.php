<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('users', function (Blueprint $table) {
        $table->string('phone')->nullable()->after('email');
        $table->string('avatar')->nullable()->after('password');
        $table->enum('role', ['customer', 'admin', 'staff'])->default('customer')->after('avatar');
        $table->boolean('is_active')->default(true)->after('role');
        $table->text('address')->nullable()->after('is_active');
        $table->string('province')->nullable();
        $table->string('district')->nullable();
        $table->string('ward')->nullable();
        // $table->timestamp('email_verified_at')->nullable();
        // $table->rememberToken();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
