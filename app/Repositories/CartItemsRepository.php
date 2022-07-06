<?php

namespace App\Repositories;

use App\Models\CartItems;
use App\Repositories\CartItemsRepositoryInterface;

/**
 * Class CartItemsRepository
 *
 * @package \App\Repositories
 */
class CartItemsRepository implements CartItemsRepositoryInterface
{

    /**
     * @var  CartItems
     */
    protected $cartItem;

    /**
     * ProductCategoriesRepository constructor.
     * @param CartItems $model
     */
    public function __construct(CartItems $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    /**
     * Get all CartItems
     * @return CartItems
     */
    public function all()
    {
        return $this->cartItem
            ->with('product.category')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->cartItem
            ->with('product.category')
            ->findOrFail($id);
    }

    public function save(array $data)
    {
        $collection = collect($data);
        $cartItem =  $this->cartItem->create([
            'product_id' => $collection->get('product_id'),
        ]);

        return $cartItem;
    }

    public function update(int $id, array $data)
    {
        $cartItem = $this->getById($id);
        $collection = collect($data);

        if($collection->get('product_id')) {
            $cartItem->product_id = $collection->get('product_id');
            $cartItem->save();
        }

        return $cartItem;
    }

    public function delete(int $id)
    {
        $cartItem = $this->getById($id);
        $cartItem->delete();
        return $cartItem;
    }
}
