<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Zenaton\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Client::init(config('services.zenaton.app_id'), config('services.zenaton.api_token'), config('services.zenaton.app_env'));
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
