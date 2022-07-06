<?php

namespace App\Contracts;

/**
 * Interface ProductsContract
 * @package App\Contracts
 */
interface ProductContract
{
    /**
     * @param array $columns
     */
    public function listProducts(array $columns = ['*']);

    /**
     * @param int $id
     */
    public function findProductById(int $id);

    /**
     * @param array $params
     */
    public function createProduct(array $params);

    /**
     * @param array $params
     */
    public function updateProduct(array $params);

    /**
     * @param $id
     */
    public function deleteProduct($id);
}
