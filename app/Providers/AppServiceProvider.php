<?php

namespace App\Providers;

use App\Models\Company;
use App\Repositories\FileRepository;
use App\Repositories\Interfaces\CompanyInterface;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\FileInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(CompanyInterface::class , CompanyRepository::class);
        $this->app->bind(FileInterface::class , FileRepository::class);
    }
}
