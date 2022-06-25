<?php

namespace App\Providers;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPasswordBroker();
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }


    /**
     * @return void
     */
    protected function registerPasswordBroker(): void
    {
        $this->app->singleton('auth.password', function ($app) {
            return new PasswordBrokerManager($app);
        });

        $this->app->bind('auth.password.broker', function ($app) {
            return $app->make('auth.password')->broker();
        });
    }
}
