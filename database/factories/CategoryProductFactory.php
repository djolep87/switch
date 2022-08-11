<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */



    public function definition()
    {
        return [
            'product_id' => rand(1, 100),
            'category_id' => rand(1, 30),
        ];
    }
}
