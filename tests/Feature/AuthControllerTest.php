<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::query()
            ->where('email', 'test@example.com')
            ->first();
    }

    public function test_login(): void
    {
        $response = $this->post(route('auth.login'), [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $response->assertSuccessful();

        /** @var User $user */
        $user = Auth::user();
        $this->assertModelExists($user);
    }

    public function test_logout(): void
    {
        $responseAuth = $this->post(route('auth.login'), [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $response = $this
            ->withToken($responseAuth->json('token'))
            ->post(route('auth.logout'));

        $response->assertSuccessful();
    }
}
