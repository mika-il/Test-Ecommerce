<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\ProductCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A feature get all product test.
     *
     */
    public function testGettingAllProducts()
    {
        $category = ProductCategories::factory()->create();
        Products::factory()->create([
            'name' => 'Apple MacBook Pro 2021 M1 PRO',
            'price' => '96900.00',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('image-test.jpg')
        ]);

        Products::factory()->create([
            'name' => 'Apple MacBook Air M1',
            'price' => '31000.00',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('image-test.jpg')
        ]);

        $route = route('products.index');
        $this->json('GET', $route, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }


    /**
     * A feature create product test.
     *
     */
    public function testCreateProduct()
    {
        $filename = 'image-test.jpg';
        $category = ProductCategories::factory()->create();

        $route = route('products.store');
        $request = [
            'name' => 'Apple MacBook Pro 2021 M1 PRO',
            'price' => '96900.00',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image($filename)
        ];

        $this->post($route, $request, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Apple MacBook Pro 2021 M1 PRO',
                    'price' => '96,900.00',
                    'category' => $category->name,
                    'image' => $filename
                ]
            ]);
    }


    /**
     * A feature update product test.
     *
     */
    public function testUpdateProduct()
    {
        $filename = 'image-create.jpg';
        $filenameRequest = 'image-update.jpg';
        $category = ProductCategories::factory()->create();
        $product = Products::factory()->create([
            'name' => 'Apple MacBook Pro 2021 M1 PRO',
            'price' => '96900.00',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image($filename)
        ]);

        $route = route('products.update', [
            'product' => $product->id,
        ]);

        $request = [
            'name' => 'Apple MacBook Pro',
            'image' => UploadedFile::fake()->image($filenameRequest)
        ];

        $this->json('PUT', $route , $request, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Apple MacBook Pro',
                    'price' => '96,900.00',
                    'category' => $category->name,
                    'image' => $filenameRequest
                ]
            ]);
    }

    /**
     * A feature delete product test.
     *
     */
    public function testDeleteProduct()
    {
        $category = ProductCategories::factory()->create();
        $product = Products::factory()->create([
            'name' => 'Apple MacBook Pro 2021 M1 PRO',
            'price' => '96900.00',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('image-test.jpg')
        ]);

        $route = route('products.destroy', [
            'product' => $product->id,
        ]);

        $this->json('DELETE', $route , ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Product deleted successfully'
        ]);
    }
}
