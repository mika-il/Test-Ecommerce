<?php

namespace App\Repositories;

use App\Models\Products;
use App\Traits\UploadFileTrait;
use App\Repositories\ProductsRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ProductsRepository
 *
 * @package \App\Repositories
 */
class ProductsRepository implements ProductsRepositoryInterface
{
    use UploadFileTrait;

    /**
     * @var  Products
     */
    protected $products;

    /**
     * ProductsRepository constructor.
     * @param Product $model
     */
    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    /**
     * Get all Products
     * @return Products
     */
    public function getAll()
    {
        return $this->products
            ->with('category')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->products
            ->with('category')
            ->where('id', $id)
            ->firstOrFail();
    }

    public function save(array $data)
    {
        $collection = collect($data);
        $image = null;

        if($collection->get('image')) {
            $image = $this->uploadFile($collection->get('image'), 'project');
        }

        $product =  $this->products->create([
            'name' => $collection->get('name'),
            'price' => $collection->get('price'),
            'category_id' => $collection->get('category_id'),
            'image' =>  $image
        ]);

        return $product;
    }

    public function update(int $id, array $data)
    {
        $product = $this->getById($id);
        $collection = collect($data);
        $image = $product->image;

        if($collection->get('image')) {
            if ($image != null) {
                $path = 'project/' . $product->image;
                $this->deleteFile($path);
            }

            $image = $this->uploadFile($collection->get('image'), 'project');
        }

        $merge = $collection->merge(compact('image'));
        $product->update($merge->all());

        return $product;
    }

    public function delete(int $id)
    {
        $product = $this->getById($id);
        if ($product->image != null) {
            $path = 'project/' . $product->image;
            $this->deleteFile($path);
        }

        $product->delete();
        return  $product;
    }
}
