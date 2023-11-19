<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Otp\OtpRepository;
use App\Repositories\Otp\OtpRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\S3\UploadFileRepository;
use App\Repositories\S3\UploadFileRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UploadFileRepositoryInterface::class,UploadFileRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(OtpRepositoryInterface::class,OtpRepository::class);
        $this->app->bind(CartRepositoryInterface::class,CartRepository::class);

    }
}
