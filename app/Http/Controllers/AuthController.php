<?php

namespace App\Http\Controllers;

use App\Dto\LoginDto;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = LoginDto::fromRequest($request->validated());
        return response()->json($this->service->login($dto));
    }

    public function logout(): JsonResponse
    {
        return response()->json($this->service->logout());
    }
}
