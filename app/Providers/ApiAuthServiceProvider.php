<?php
namespace App\Providers;

use App\Services\Auth\ApiAuthUserProvider;
use Illuminate\Support\ServiceProvider;

class ApiAuthServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app ['auth']->provider('externalauthapi',
                function ($app) {
                    return $app->make('App\Services\Auth\ApiAuthUserProvider');
                });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Auth\ApiAuthUserProvider',
                function ($app) {
                    return new ApiAuthUserProvider($app->make('App\Services\Api\ApiService'));
                });
    }
}