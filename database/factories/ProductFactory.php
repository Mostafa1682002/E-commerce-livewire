<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $product_name = $this->faker->unique()->words($nb = 2, $asText = true);
        $slug = Str::slug($product_name, '-');
        $n = $this->faker->numberBetween(1, 15);
        return [
            'category_id' => Category::all()->unique()->random()->id,
            'name' => $product_name,
            'slug' => $slug,
            'short_description' => $this->faker->text(150),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(10, 500),
            'main_image_1' => 'assets-front/imgs/shop/product-' . $n . '-1.jpg',
            'main_image_2' => 'assets-front/imgs/shop/product-' . $n . '-2.jpg',
            'quantity' => $this->faker->numberBetween(10, 25),
        ];
    }
}
