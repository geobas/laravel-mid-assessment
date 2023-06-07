<?php

namespace Database\Factories;

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
        return [
            'name' => $name = ucfirst(fake()->words(3, true)),
            'slug' => str()->slug($name),
            'sku' => strtoupper(fake()->lexify('??????????')),
            'short_description' => fake()->sentence(3, false),
            'description' => fake()->paragraph(3, false),
            'price' => fake()->randomFloat(2, 10, 100),
            'stock' => 100,
        ];
    }
}
