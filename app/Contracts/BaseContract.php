<?php

namespace App\Contracts;

/**
 * Interface BaseContract
 * @package App\Contracts
 */

interface BaseContract
{
    /**
     * Create a model instance
     */
    public function create(array $attributes);

    /**
     * Update a model instance
     */
    public function update(array $attributes, int $id);

    /**
     * Return all model rows
     */
    public function all($columns = ['*']);

    /**
     * Find one by ID
     */
    public function find(int $id);

    /**
     * Find one by ID or throw exception
     */
    public function findOneOrFail(int $id);

    /**
     * Delete one by Id
     */
    public function delete(int $id);
}
