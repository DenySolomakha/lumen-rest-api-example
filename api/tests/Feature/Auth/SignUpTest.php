<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccess(): void
    {
        /** @var User $user */
        $user = User::factory()->make();

        $response = $this->post(route('signUp'), [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ]);

        $response->seeJsonStructure([
            'data' => [
                'id',
                'username',
                'email',
                'createdAt',
                'token'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function testInvalidCredentials(): void
    {
        $response = $this->post(route('signUp'), [
            'username' => 'invalid',
            'email' => 'invalid',
            'password' => 'invalid',
            'password_confirmation' => 'invalid',
        ]);

        $response->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
