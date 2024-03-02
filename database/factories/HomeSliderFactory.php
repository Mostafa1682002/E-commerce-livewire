<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeSlider>
 */
class HomeSliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'top_title' => ucwords($this->faker->text(20)),
            'title' => ucwords($this->faker->text(25)),
            'sub_title' => ucwords($this->faker->text(20)),
            'offer' => ucwords($this->faker->text(40)),
            'image' => 'assets-front/imgs/slider/slider-' . $this->faker->numberBetween(1, 3) . '.png',
            'status' => 1,
        ];
    }
}
