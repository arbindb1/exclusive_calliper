<?php

namespace App\Providers;

use App\Interfaces\CalliperBeadTrimServiceInterface;
use App\Interfaces\CalliperNumberServiceInterface;
use App\Interfaces\CalliperImageServiceInterface;
use App\Services\CalliperBeadTrimService;
use App\Services\CalliperNumberService;
use App\Services\CalliperImageService;
use Illuminate\Support\ServiceProvider;

class CalliperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CalliperImageServiceInterface::class, CalliperImageService::class);
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
