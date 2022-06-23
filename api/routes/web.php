<?php

/** @var Router $router */

use App\Http\Controllers\Auth\SignIn;
use App\Http\Controllers\Auth\SignUp;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router): string {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function (Router $router): void {
    // Generate random string for application key
    $router->get('appKey', fn ():string => Str::random(32));

    // Authentication
    $router->post('signUp', ['as' => 'SignUp', 'uses' => SignUp::class]);
    $router->post('signIn', ['as' => 'SignIn', 'uses' => SignIn::class]);
});
