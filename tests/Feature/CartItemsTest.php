<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\CartItems;
use App\Models\Products;
use App\Http\Resources\ProductsResource;
use Tests\TestCase;

class CartItemsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A feature getting all cart items test.
     *
     */
    public function testGettingAllCartItems()
    {

        CartItems::factory()->count(3)->create();
        $route = route('cart-items.index');

        $this->json('GET', $route, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    /**
     * A feature create cart item test.
     *
     */
    public function testCreateCartItem()
    {
        $product = Products::factory()->create();

        $route = route('cart-items.store');
        $request = [
            'product_id' => $product->id
        ];

        $this->post($route, $request, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'product' => [
                        'id' => $product->id,
                        'name' =>  $product->name,
                        'price' =>  $product->price,
                        'category' => $product->category->name,
                        'image' =>  $product->image
                    ]
                ]
            ]);
    }

    /**
     * A feature update cart item test.
     *
     */
    public function testUpdateCartItem()
    {
        $cartItem = CartItems::factory()->create();
        $product = Products::factory()->create();

        $route = route('cart-items.update', [
            'cart_item' => $cartItem->id,
        ]);

        $request = [
            'product_id' => $product->id
        ];

        $this->json('PUT', $route , $request, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'product' => [
                        'id' => $product->id,
                        'name' =>  $product->name,
                        'price' =>  $product->price,
                        'category' => $product->category->name,
                        'image' =>  $product->image
                    ]
                ]
            ]);
    }

    /**
     * A feature delete cart item test.
     *
     */
    public function testDeleteCartItem()
    {
        $cartItem = CartItems::factory()->create();
        $route = route('cart-items.destroy', [
            'cart_item' => $cartItem->id,
        ]);

        $this->json('DELETE', $route , ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Cart item deleted successfully'
        ]);
    }


}
