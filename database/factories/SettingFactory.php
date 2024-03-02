<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => "+201064564850",
            'email' => "most@gmail.com",
            'address' => "30 Ahmed Maher Street , Mansoura , Egypt",
            'logo' => 'assets-front/imgs/logo/logo.png',
            'ins_link' => Null,
            'tw_link' => Null,
            'face_link' => Null,
            'you_link' => Null,
        ];
    }
}
