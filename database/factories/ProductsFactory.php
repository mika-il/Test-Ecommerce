<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Products;
use App\Models\ProductCategories;

class ProductsFactory extends Factory
{
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween($min = 1000, $max = 9000) . '.00',
            'category_id' => ProductCategories::factory(),
            'image' => null
        ];
    }
}
