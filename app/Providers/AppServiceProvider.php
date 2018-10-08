<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\Observers\VillageObserver;
use App\User;
use App\Village;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Village::observe(VillageObserver::class);

        Validator::extend('without_spaces', function (string $attr, string $value) {
            return preg_match('/^\S*$/u', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
