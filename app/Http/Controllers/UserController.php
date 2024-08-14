<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    public const LOGIN_ERROR = 'The credentials provided do not match our records.';

    public function show(User $user): JsonResponse
    {
        if ( ! $user) {
            throw new NotFoundHttpException();
        }

        return response()->json($user);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->withErrors([
                'message' => self::LOGIN_ERROR,
            ]);
        }
    }
}
