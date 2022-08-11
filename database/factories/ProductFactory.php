<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $models = Product::class;


    public function definition()
    {
        return [
            'name' => $this->faker->text(20),
            'user_id' => rand(1, 100),
            'category_id' => Category::factory(),
            'condition' => 'Polovno',
            'description' => $this->faker->text(500),
            'image' => 'noimage.jpg',
        ];
    }
}
