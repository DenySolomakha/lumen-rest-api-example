<?php

/** @var Router $router */

use App\Http\Controllers\Auth\ForgotPasswordAction;
use App\Http\Controllers\Auth\ResetPasswordAction;
use App\Http\Controllers\Auth\SignInAction;
use App\Http\Controllers\Auth\SignOutAction;
use App\Http\Controllers\Auth\SignUpAction;
use App\Http\Controllers\Company\CompanyAction;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router): string {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function (Router $router): void {
    // Generate random string for application key
    $router->get('appKey', fn (): string => Str::random(32));

    // Authentication
    $router->post('signUp', ['as' => 'signUp', 'uses' => SignUpAction::class]);
    $router->post('signIn', ['as' => 'signIn', 'uses' => SignInAction::class]);
    $router->post('signOut', ['as' => 'signOut', 'uses' => SignOutAction::class]);

    // Forgot password
    $router->post('forgot-password', ['as' => 'forgot.password', 'uses' => ForgotPasswordAction::class]);
    $router->patch('reset-password', ['as' => 'reset.password', 'uses' => ResetPasswordAction::class]);

    $router->group(['middleware' => 'auth'], function (Router $router): void {
        $router->get('users/companies', ['as' => 'users.companies', 'uses' => CompanyAction::class]);
    });
});
