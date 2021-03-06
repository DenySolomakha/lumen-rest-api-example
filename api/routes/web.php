<?php

/** @var Router $router */

use App\Http\Controllers\Auth\ForgotPasswordAction;
use App\Http\Controllers\Auth\ResetPasswordAction;
use App\Http\Controllers\Auth\SignInAction;
use App\Http\Controllers\Auth\SignOutAction;
use App\Http\Controllers\Auth\SignUpAction;
use App\Http\Controllers\Company\CompaniesAction;
use App\Http\Controllers\Company\CompanyAction;
use App\Http\Controllers\Company\CreateCompanyAction;
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

    // Forgot password
    $router->post('forgot-password', ['as' => 'forgot.password', 'uses' => ForgotPasswordAction::class]);
    $router->patch('reset-password', ['as' => 'password.reset', 'uses' => ResetPasswordAction::class]);

    $router->group(['middleware' => 'auth:api'], function (Router $router): void {
        // Logout
        $router->post('signOut', ['as' => 'signOut', 'uses' => SignOutAction::class]);
        $router->get('users/companies', ['as' => 'users.companies', 'uses' => CompaniesAction::class]);
        // Identifier as id or slug
        $router->get('users/companies/{identifier}', ['as' => 'users.company', 'uses' => CompanyAction::class]);
        $router->post('users/companies', ['as' => 'create.users.companies', 'uses' => CreateCompanyAction::class]);
    });
});
