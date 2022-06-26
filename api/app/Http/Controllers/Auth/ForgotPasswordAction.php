<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Validators\Auth\ForgotPasswordValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordAction extends Controller
{
    use ForgotPasswordValidator;

    /**
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validateRequest($request);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT ?
            response()->json(['data' => 'Forgot password success.']) :
            response()->json(['data' => 'Forgot password error.'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
