<?php

namespace App\Providers;

use App\Repositories\AgencyRepositoryEloquent;
use App\Repositories\AgencyRepositoryInterface;
use App\Repositories\AuthorRepositoryEloquent;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\BookRepositoryEloquent;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryEloquent::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepositoryEloquent::class);
        $this->app->bind(AgencyRepositoryInterface::class, AgencyRepositoryEloquent::class);
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
