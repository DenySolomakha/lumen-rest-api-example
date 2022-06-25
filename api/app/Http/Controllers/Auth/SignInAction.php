<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Validators\Auth\SingInValidator;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

final class SignInAction extends Controller
{
    use SingInValidator;

    /**
     * @throws ValidationException
     */
    public function __invoke(Request $request): UserResource|JsonResponse
    {
        $this->validateRequest($request);

        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'data' => 'Invalid credentials.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        /** @var User $user */
        $user = auth()->user();
        $user->token = $token;

        return new UserResource(auth()->user());
    }
}
