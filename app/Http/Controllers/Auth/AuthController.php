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

        return RedirectWithNotification::flash(
            true,
            'Berhasil Login',
            'Gagal login',
        );
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        // return redirect()->route('login')->with('message', 'Logout berhasil.');
        return RedirectWithNotification::flash(
            true,
            'Berhasil logout',
            'Gagal logout',
        );
    }
}
