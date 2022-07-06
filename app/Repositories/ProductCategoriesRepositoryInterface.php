<?php

namespace App\Repositories;


/**
 * Interface ProductCategoriesRepositoryInterface
 *
 * @package \App\Repositories
 */

interface ProductCategoriesRepositoryInterface
{
    public function all();

    public function findById(int $id);

    public function save(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}

