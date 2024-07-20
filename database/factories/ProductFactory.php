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
            'product_type_id' => ProductType::factory(),
            'value' => fake()->randomNumber(),
            'minimum_amount' => 1,
            'maximum_amount' => 15
        ];
    }
}
