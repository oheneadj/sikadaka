<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
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
        //Prevent lazy loading
        Model::preventLazyLoading();

        //Global Gates
        Gate::define('is_admin', function (User $user) {
            return $user->role === UserRoleEnum::Admin;
        });

        Gate::define('is_collector', function (User $user) {
            return $user->role === UserRoleEnum::Collector;
        });
    }
}
