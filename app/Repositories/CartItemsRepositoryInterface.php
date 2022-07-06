<?php

namespace App\Repositories;


/**
 * Interface CartItemsRepositoryInterface
 *
 * @package \App\Repositories
 */

interface CartItemsRepositoryInterface
{
    public function all();

    public function getById(int $id);

    public function save(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}

