<?php

declare(strict_types=1);

namespace App\Http\Validators\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait ForgotPasswordValidator
{
    /**
     * @throws ValidationException
     */
    protected function validateRequest(Request $request): void
    {
        $this->validate($request, [
            'email' => 'required|exists:users|email',
        ]);
    }
}
