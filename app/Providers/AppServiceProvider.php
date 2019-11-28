<?php

namespace App\Providers;

use App\Repositories\Attendance\AttendanceInterface;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\Employee\EmployeeInterface;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Holiday\HolidayInterface;
use App\Repositories\Holiday\HolidayRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        $this->app->singleton(EmployeeInterface::class, EmployeeRepository::class);
        $this->app->singleton(AttendanceInterface::class, AttendanceRepository::class);
        $this->app->singleton(HolidayInterface::class, HolidayRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS'))
        {
            \URL::forceScheme('https');
        }
    }
}
