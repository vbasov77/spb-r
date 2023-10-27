<?php

namespace App\Providers;

use App\Models\Archive;
use App\Services\ArchiveService;
use App\Services\BookingService;
use App\Services\Service;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Service::class, ArchiveService::class);
        $this->app->bind(Service::class, BookingService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
