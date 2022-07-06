<?php

namespace App\Http\Controllers;

use App\Repositories\CartItemsRepositoryInterface;
use App\Http\Resources\CartItemsResource;
use App\Http\Requests\StoreCartItemsRequest;
use App\Http\Requests\UpdateCartItemsRequest;
use Illuminate\Http\Request;

class ApiCartItemsController extends Controller
{
    protected $cartItemsRepository;

    public function __construct(CartItemsRepositoryInterface $cartItemsRepository)
    {
        $this->cartItemsRepository = $cartItemsRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CartItemsResource::collection($this->cartItemsRepository->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartItemsRequest $request)
    {
        $cartItem =  $this->cartItemsRepository->save($request->only(['product_id']));

        if(!$cartItem) {
            return response()->json([
                'message' => 'Error occurred while creating cart item.'
            ], 500);
        }

        $cartItem->load('product.category');

        return new CartItemsResource($cartItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CartItemsResource($this->cartItemsRepository->getById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartItemsRequest $request, $id)
    {
        $cartItem = $this->cartItemsRepository->update($id, $request->only(['product_id']));

        if(!$cartItem) {
            return response()->json([
                'message' => 'Error occurred while updating  cart item.'
            ], 500);
        }

        $cartItem->load('product.category');
        return new CartItemsResource($cartItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItem = $this->cartItemsRepository->delete($id);
        if(!$cartItem) {
            return response()->json([
                'message' => 'Error occurred while deleting cart item.'
            ], 500);
        }

        return response()->json([
            'message' => 'Cart item deleted successfully'
        ], 200);
    }
}
