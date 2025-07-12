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
                'Berhasil login sebagai admin.',
                '',
                3000
            ),

            'staf' => RedirectWithNotification::toNamedRoute(
                'staf.dashboard',
                true,
                'Berhasil login sebagai staf.',
                '',
                3000
            ),

            'notaris' => RedirectWithNotification::toNamedRoute(
                'notaris.dashboard',
                true,
                'Berhasil login sebagai notaris.',
                '',
                3000
            ),
            'klien' => RedirectWithNotification::toNamedRoute(
                'klien.dashboard',
                true,
                'Berhasil login sebagai klien.',
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

        // return RedirectWithNotification::back(
        //     true,
        //     'Berhasil Login',
        //     'Gagal login',
        // );
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        // return redirect()->route('login')->with('message', 'Logout berhasil.');
        return RedirectWithNotification::back(
            true,
            'Berhasil logout',
            'Gagal logout',
        );
    }
}
