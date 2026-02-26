<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
                ->count(20)
                ->has(ProductImage::factory()->count(rand(3,5)), 'Images') // this Images function is define in Product model for relationship
                ->create();
    }
}
