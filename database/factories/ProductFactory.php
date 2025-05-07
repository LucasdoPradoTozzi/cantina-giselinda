<?php

namespace Database\Factories;

use App\Models\ProductType;
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
            'name' => fake()->randomElement([
                'Pizza',
                'Sushi',
                'Hambúrguer',
                'Taco',
                'Salada',
                'Lasanha',
                'Bife',
                'Sopa',
                'Sanduíche',
                'Sorvete',
                'Pasta',
                'Frango Frito',
                'Empanada',
                'Paella',
                'Ramen'
            ]),
            'description' => fake()->text(),
            'product_type_id' => ProductType::factory(),
            'buy_value' => floatval(fake()->numberBetween(1, 15)),
            'value' => floatval(fake()->numberBetween(16, 30)),
            'minimum_amount' => $this->faker->numberBetween(1, 10),
            'maximum_amount' => $this->faker->numberBetween(11, 20),
            'photo_path' => null
        ];
    }
}
