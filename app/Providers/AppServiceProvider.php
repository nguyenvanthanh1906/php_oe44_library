<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Authors\AuthorRepositoryInterface::class,
            \App\Repositories\Authors\AuthorRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Puplishers\PuplisherRepositoryInterface::class,
            \App\Repositories\Puplishers\PuplisherRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Statuses\StatusRepositoryInterface::class,
            \App\Repositories\Statuses\StatusRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
