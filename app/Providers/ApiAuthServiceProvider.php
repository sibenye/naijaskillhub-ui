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
                function () {
                    return new ApiAuthUserProvider();
                });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}