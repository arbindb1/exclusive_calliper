<?php

namespace App\Providers;

use App\Interfaces\CalliperBeadTrimServiceInterface;
use App\Interfaces\CalliperNumberServiceInterface;
use App\Interfaces\ImageServiceInterface;
use App\Services\CalliperBeadTrimService;
use App\Services\CalliperNumberService;
use App\Services\ImageService;
use Illuminate\Support\ServiceProvider;

class CalliperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ImageServiceInterface::class, ImageService::class);
        $this->app->singleton(CalliperNumberServiceInterface::class, CalliperNumberService::class);
        $this->app->singleton(CalliperBeadTrimServiceInterface::class, CalliperBeadTrimService::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
