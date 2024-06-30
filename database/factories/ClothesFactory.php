<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clothes>
 */
class ClothesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        return [
            'reference' => $this->faker->regexify('[A-Z0-9]{16}'),
            'name'=>$this->faker->sentence(2, true),
           'description'=>$this->faker->paragraph,
           'price'=>$this->faker->randomFloat(2,50,200),
           'status'=>$this->faker->randomElement(['standard', 'sale']),
           'visibility'=>$this->faker->randomElement(['published', 'unpublished'])
        ];
    } 

}