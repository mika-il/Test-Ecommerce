<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductsRepositoryInterface;
use App\Http\Resources\ProductsResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ApiProductsController extends Controller
{
    protected $productsRepository;

    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return ProductsResource::collection($this->productsRepository->getAll());
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $product =  $this->productsRepository->getById($id);
        return new ProductsResource($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreProductRequest $request)
    {
        $product =  $this->productsRepository->save($request->only(['name', 'price', 'category_id', 'image']));

        if(!$product) {
            return response()->json([
                'message' => 'Error occurred while creating product.'
            ], 500);
        }

        return new ProductsResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->productsRepository->update($id, $request->only(['name', 'price', 'category_id', 'image']));

        if(!$product) {
            return response()->json([
                'message' => 'Error occurred while updating product.'
            ], 500);
        }

        return new ProductsResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $product = $this->productsRepository->delete($id);
        if(!$product) {
            return response()->json([
                'message' => 'Error occurred while deleting product.'
            ], 500);
        }

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
