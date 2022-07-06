<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProductsController;
use App\Http\Controllers\ApiProductCategoriesController;
use App\Http\Controllers\ApiCartItemsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('products', ApiProductsController::class);
Route::resource('cart-items', ApiCartItemsController::class);
Route::resource('categories', ApiProductCategoriesController::class);
