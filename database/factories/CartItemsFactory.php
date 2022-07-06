<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CartItems;
use App\Models\Products;

class CartItemsFactory extends Factory
{
    protected $model = CartItems::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Products::factory()
        ];
    }
}
