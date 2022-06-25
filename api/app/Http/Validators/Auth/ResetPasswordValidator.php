<?php

declare(strict_types=1);

namespace App\Http\Validators\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

trait ResetPasswordValidator
{
    /**
     * @throws ValidationException
     */
    protected function validateRequest(Request $request): void
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(6)->mixedCase()->letters()],
        ]);
    }
}
