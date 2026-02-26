<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name'  => $this->faker->sentence(rand(1,3)),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2,99,9999),
            'stock' => $this->faker->numberBetween(0,500),
            'category_id' => Category::factory(),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-########')),
            'weight' => $this->faker->randomFloat(2, 0.1, 10), //Kg
            'dimension' => $this->faker->numberBetween(10,100) . 'x' .
                        $this->faker->numberBetween(10, 100). 'x'.
                        $this->faker->numberBetween(1,50),
            'is_active' => true
        ];
    }
}
