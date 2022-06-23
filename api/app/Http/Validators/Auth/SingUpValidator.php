<?php

declare(strict_types=1);

namespace App\Http\Validators\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

trait SingUpValidator
{
    /**
     * @throws ValidationException
     */
    protected function validateRequest(Request $request): void
    {
        $this->validate($request, [
            'username' => 'required|string|unique:users|max:50',
            'email' => 'required|unique:users|email',
            'password' => ['required', 'confirmed', Password::min(6)->mixedCase()->letters()],
        ]);
    }
}
