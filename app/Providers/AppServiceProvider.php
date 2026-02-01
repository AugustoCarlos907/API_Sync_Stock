<?php

namespace App\Providers;

use App\Models\Company;
use App\Repositories\FileRepository;
use App\Repositories\Interfaces\CompanyInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\FileInterface;
use App\Repositories\Interfaces\StockItemInterface;
use App\Repositories\StockItemRepository;
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
        $this->app->bind(StockItemInterface::class , StockItemRepository::class);
    }
}
