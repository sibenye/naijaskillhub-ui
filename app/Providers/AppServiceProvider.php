<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utilities\HttpClient;
use App\Services\Api\ApiService;

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
                    return new ApiService(new HttpClient(env('NSH_API_BASE_URL')));
                });
    }
}
