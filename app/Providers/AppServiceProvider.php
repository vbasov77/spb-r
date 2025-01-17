<?php

namespace App\Providers;

use App\Http\Services\ObjService;
use App\Services\ArchiveService;
use App\Services\BookingService;
use App\Services\DateService;
use App\Services\KeyService;
use App\Services\MailService;
use App\Services\NewsService;
use App\Services\ObjectService;
use App\Services\OrderService;
use App\Services\PayService;
use App\Services\QueueService;
use App\Services\ReportService;
use App\Services\ScheduleService;
use App\Services\Service;
use App\Services\SettingsService;
use App\Services\TopPlaceService;
use App\Services\UserService;
use App\Services\VkService;
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
        $this->app->bind(Service::class, DateService::class);
        $this->app->bind(Service::class, KeyService::class);
        $this->app->bind(Service::class, MailService::class);
        $this->app->bind(Service::class, OrderService::class);
        $this->app->bind(Service::class, PayService::class);
        $this->app->bind(Service::class, QueueService::class);
        $this->app->bind(Service::class, ReportService::class);
        $this->app->bind(Service::class, ScheduleService::class);
        $this->app->bind(Service::class, SettingsService::class);
        $this->app->bind(Service::class, UserService::class);
        $this->app->bind(Service::class, NewsService::class);
        $this->app->bind(Service::class, VkService::class);
        $this->app->bind(Service::class, TopPlaceService::class);
        $this->app->bind(Service::class, ObjectService::class);
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
