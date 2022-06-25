<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Validators\Auth\SingUpValidator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

final class SignUpAction extends Controller
{
    use SingUpValidator;

    /**
     * @param Request $request
     * @return JsonResource
     * @throws Throwable
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResource
    {
        $this->validateRequest($request);

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->saveOrFail();

        $user->token = auth()->attempt($request->only('email', 'password'));

        return (new UserResource($user));
    }
}
