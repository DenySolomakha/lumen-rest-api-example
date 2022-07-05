<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class SignOutTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccess(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        // TODO: refactor setting token.
        $response = $this->post(route('signOut'), headers: ['authorization' => 'Bearer ' . '']);

        //$response->assertResponseStatus(Response::HTTP_UNAUTHORIZED);

        $this->markTestSkipped();
    }
}
