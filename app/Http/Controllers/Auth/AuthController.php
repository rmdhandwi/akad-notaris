<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use App\Services\RedirectWithNotification;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // return login page
    public function index()
    {
        if(auth()->check())
        {
            return RedirectWithNotification::back(
                false,
                '',
                'Logout hanya melalui tombol logout',
                5000
            );
        }
        
        return Inertia::render('Auth/Login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->authService->login($validated);

        $user = auth()->user();

        return match (strtolower($user->role->role_name) ?? null) {
            'admin' => RedirectWithNotification::toNamedRoute(
                'admin.dashboard',
                true,
                'Selamat Datang '.$user->username,
                '',
                3000
            ),

            'staf' => RedirectWithNotification::toNamedRoute(
                'staf.dashboard',
                true,
                'Selamat Datang '.$user->username,
                '',
                3000
            ),

            'notaris' => RedirectWithNotification::toNamedRoute(
                'notaris.dashboard',
                true,
                'Selamat Datang '.$user->username,
                '',
                3000
            ),
            'klien' => RedirectWithNotification::toNamedRoute(
                'klien.dashboard',
                true,
                'Selamat Datang '.$user->username,
                '',
                3000
            ),

            default => RedirectWithNotification::toNamedRoute(
                'user.login.index',
                false,
                '',
                'Role tidak dikenali.',
                4000
            ),
        };
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return RedirectWithNotification::toNamedRoute(
            'user.login.index',
            true,
            'Berhasil logout',
            '',
        );
    }
}
