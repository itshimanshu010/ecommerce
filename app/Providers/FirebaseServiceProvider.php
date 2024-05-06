<?php

namespace App\Providers;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Support\ServiceProvider;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            $serviceAccount = ServiceAccount::fromValue($app['config']['firebase.credentials']);
    
            return (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri($app['config']['firebase.database_url'])
                ->create();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
