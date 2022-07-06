<?php

namespace App\Http\Controllers;

use App\Repositories\ProductCategoriesRepositoryInterface;
use App\Http\Resources\ProductCategoriesResource AS CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class ApiProductCategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(ProductCategoriesRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection($this->categoryRepository->all());
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =  $this->categoryRepository->findById($id);
        return new CategoryResource($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category =  $this->categoryRepository->save($request->only(['name']));

        if(!$category) {
            return response()->json([
                'message' => 'Error occurred while creating product category.'
            ], 500);
        }

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->update($id, $request->only(['name']));

        if(!$category) {
            return response()->json([
                'message' => 'Error occurred while updating  product category.'
            ], 500);
        }

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->delete($id);
        if(!$category) {
            return response()->json([
                'message' => 'Error occurred while deleting product category.'
            ], 500);
        }

        return response()->json([
            'message' => 'Product category deleted successfully'
        ], 200);
    }
}
