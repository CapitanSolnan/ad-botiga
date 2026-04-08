<?php

namespace Database\Factories;

use App\Models\Productes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Productes>
 */
class ProductesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition()
{
    return [
        "nom" => $this->faker->word(),
        "preu" => $this->faker->randomFloat(2, 1, 500),
        "img" => $this->faker->imageUrl(640, 480, 'products', true),
    ];
}
}
