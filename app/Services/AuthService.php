<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    /**
     * @throws Exception
     */
    public function login(LoginDto $dto): array
    {
        if (Auth::attempt([
            'email' => $dto->email,
            'password' => $dto->password
        ])) {
            return [
                'token' => Auth::user()->createToken(
                    name: 'auth.token',
                    expiresAt: Carbon::now(config('app.timezone_database'))
                        ->addMinutes(config('session.lifetime'))
                )
                    ->plainTextToken
            ];
        }

        throw new Exception('Authorization was failed.', 401);
    }

    public function logout(): User
    {
        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->delete();
        return $user;
    }
}
