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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('description')->constrained('categories')->onDelete('set null');
            $table->string('brand')->nullable()->after('category_id');
            $table->string('gender')->nullable()->after('brand'); // Hombre, Mujer, Unisex
            $table->integer('stock')->default(10)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'brand', 'gender', 'stock']);
        });
    }
};
