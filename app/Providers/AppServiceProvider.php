<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utilities\HttpClient;
use App\Services\ApiWrapper\ApiService;
use App\Services\Account\ProfileService;
use App\Services\StatesService;
use App\Utilities\DropboxClientWrapper;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Api\ApiService',
                function ($app) {
                    return new ApiService(new HttpClient());
                });

        $this->app->singleton('App\Utilities\DropboxClientClientWrapper',
                function ($app) {
                    return new DropboxClientWrapper();
                });

        $this->app->bind('App\Services\Account\ProfileService',
                function ($app) {
                    return new ProfileService($app->make('App\Services\Api\ApiService'),
                        $app->make('App\Utilities\DropboxClientClientWrapper'));
                });

        $this->app->bind('App\Services\StatesService',
                function ($app) {
                    return new StatesService();
                });
    }
}
