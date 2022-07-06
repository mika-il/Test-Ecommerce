<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProductsRepositoryInterface;
use App\Repositories\ProductsRepository;
use App\Repositories\ProductCategoriesRepositoryInterface;
use App\Repositories\ProductCategoriesRepository;
use App\Repositories\CartItemsRepositoryInterface;
use App\Repositories\CartItemsRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        ProductsRepositoryInterface::class => ProductsRepository::class,
        ProductCategoriesRepositoryInterface::class => ProductCategoriesRepository::class,
        CartItemsRepositoryInterface::class => CartItemsRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
