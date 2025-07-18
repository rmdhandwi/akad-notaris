<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => function () use ($request)
                {
                    $user = $request->user();

                    if(!$user)
                    {
                        return null;
                    }

                    if($user->role_id === 2)
                    {
                        $user->load('stafDetails');
                    }

                    if($user->role_id === 3)
                    {
                        $user->load('notarisDetails');
                    }

                    return $user;
                }
            ],
            'flash' => [
                'notif_status' => fn () => $request->session()->get('notif_status'), //success / error
                'notif_message' => fn () => $request->session()->get('notif_message'), //isi notifikasi
                'notif_duration' => fn () => $request->session()->get('notif_duration'), //durasi notifikasi
            ],
        ];
    }
}
