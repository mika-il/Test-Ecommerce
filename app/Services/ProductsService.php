<?php

namespace App\Services;

use App\Repositories\ProductsRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ProductsService
{
    protected $productsRepository;

    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function listProducts()
    {
        return  $this->productsRepository->getAll();
    }

    public function findProductById(int $id)
    {
        $product = $this->productsRepository->getById($id);
        if(!$product) {
            throw new ModelNotFoundException();
        }

        return $product;
    }

    public function deleteProductById(int $id)
    {
        try {
            $product = $this->productsRepository->delete($id);
        } catch (Exception $e) {
           dd('xx');
        }

        return $product;
    }
}

