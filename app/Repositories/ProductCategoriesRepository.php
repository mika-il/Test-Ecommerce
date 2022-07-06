<?php

namespace App\Repositories;

use App\Models\ProductCategories;
use App\Repositories\ProductCategoriesRepositoryInterface;

/**
 * Class ProductCategoriesRepository
 *
 * @package \App\Repositories
 */
class ProductCategoriesRepository implements ProductCategoriesRepositoryInterface
{

    /**
     * @var  Categories
     */
    protected $categories;

    /**
     * ProductCategoriesRepository constructor.
     * @param ProductCategories $model
     */
    public function __construct(ProductCategories $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get all Categories
     * @return ProductCategories
     */
    public function all()
    {
        return $this->categories->get();
    }

    public function findById(int $id)
    {
        return $this->categories->findOrFail($id);
    }

    public function save(array $data)
    {
        $collection = collect($data);

        $categories =  $this->categories->create([
            'name' => $collection->get('name')
        ]);

        return $categories;
    }

    public function update(int $id, array $data)
    {
        $category = $this->findById($id);
        $collection = collect($data);

        if($collection->has('name')) {
            $category->name = $collection->get('name');
            $category->save();
        }

        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->findById($id);
        $category->delete();
        return  $category;
    }
}
