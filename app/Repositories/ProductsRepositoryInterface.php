<?php

namespace App\Repositories;


/**
 * Interface ProductsRepositoryInterface
 *
 * @package \App\Repositories
 */

interface ProductsRepositoryInterface
{
    public function getAll();

    public function getById(int $id);

    public function save(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}

