<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class SignInTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testSuccess(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->post('/api/signIn', ['email' => $user->email, 'password' => 'Password123']);

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
    public function testValidationErrors(): void
    {
        $this->post('/api/signIn', ['email' => 'incorrect', 'password' => 'incorrect'])
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return void
     */
    public function testInvalidCredentials(): void
    {
        $this->post('/api/signIn', ['email' => 'example@mail.com', 'password' => 'Incorrect123'])
        ->assertResponseStatus(Response::HTTP_UNAUTHORIZED);
    }
}
