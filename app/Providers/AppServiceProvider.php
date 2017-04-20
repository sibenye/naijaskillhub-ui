<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utilities\HttpClient;
use App\Services\ApiWrapper\ApiService;
use App\Services\Account\ProfileService;
use App\Services\StatesService;
use App\Utilities\DropboxClientWrapper;
use App\Mappers\UserMapper;
use App\Services\ApiWrapper\YoutubeApiService;
use App\Services\Account\PortfolioService;

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

        $this->app->bind('App\Services\Api\YoutubeApiService',
                function ($app) {
                    return new YoutubeApiService(new HttpClient(env('YOUTUBE_API_BASE_URL')));
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

        $this->app->bind('App\Services\Account\PortfolioService',
                function ($app) {
                    return new PortfolioService($app->make('App\Services\Api\ApiService'),
                        $app->make('App\Utilities\DropboxClientClientWrapper'),
                        $app->make('App\Services\Api\YoutubeApiService'));
                });

        $this->app->bind('App\Services\StatesService',
                function ($app) {
                    return new StatesService();
                });
    }
}
