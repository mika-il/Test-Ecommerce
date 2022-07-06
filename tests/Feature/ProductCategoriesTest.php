<?php

namespace Tests\Feature;

use App\Models\ProductCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature getting all catogories test.
     *
     * @return void
     */
    public function testGettingAllProductCategories()
    {
        ProductCategories::factory()->count(3)->create();
        $route = route('categories.index');

        $this->json('GET', $route, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    /**
     * A basic feature creat catogory test.
     *
     * @return void
     */
    public function testCreateProductCategory()
    {
        $route = route('categories.store');
        $request = [
            'name' => 'Mobile'
        ];

        $this->post($route, $request, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Mobile'
                ]
            ]);
    }

    /**
     * A feature update catogory test.
     *
     */
    public function testUpdateProductCategory()
    {
        $category = ProductCategories::factory()->create();

        $route = route('categories.update', [
            'category' => $category->id,
        ]);

        $request = [
            'name' => 'Computer',
        ];

        $this->json('PUT', $route , $request, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Computer'
                ]
            ]);
    }

    /**
     * A feature delete product category test.
     *
     */
    public function testDeleteProductCategory()
    {
        $category = ProductCategories::factory()->create();

        $route = route('categories.destroy', [
            'category' => $category->id,
        ]);

        $this->json('DELETE', $route , ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Product category deleted successfully'
            ]);
    }
}
