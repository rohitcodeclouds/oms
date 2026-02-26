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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->nullable()->unique();
            $table->decimal('weight', 8, 2)->nullable(); // in kg or grams
            $table->string('dimension')->nullable();    // e.g. 10x20x30 cm
            $table->boolean('is_active')->default(true)->index();
            $table->softDeletes();
            $table->timestamps();

            $table->index('product_name');
            $table->index('sku');
            $table->index('category_id');
            $table->index('is_active');
            $table->index('created_at');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }

};
