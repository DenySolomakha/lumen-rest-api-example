<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth as AuthFacade;

class Authenticate
{
    /**
     * Create a new middleware instance.
     *
     * @param Auth $auth
     * @return void
     */
    public function __construct(private readonly Auth $auth)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string|null $guard = null): mixed
    {
        if ($this->auth->guard($guard)->guest()) {
            return response()->json(['data' => 'Unauthorized.'], Response::HTTP_UNAUTHORIZED);
        }

        $request->attributes->set(User::class, AuthFacade::user());

        return $next($request);
    }
}
