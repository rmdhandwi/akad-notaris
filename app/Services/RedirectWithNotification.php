<?php

namespace App\Services;

class RedirectWithNotification
{
    public static function back(bool $action, string $successMessage, string $errorMessage, int $duration = 3000)
    {
        return redirect()->back()->with([
            'notif_status' => $action ? 'success' : 'error',
            'notif_message' => $action ? $successMessage : $errorMessage,
            'notif_duration' => $duration,
        ]);
    }

    public static function toNamedRoute(string $namedRoute, bool $action, string $successMessage, string $errorMessage, int $duration = 3000)
    {
        return redirect()->route($namedRoute)->with([
            'notif_status' => $action ? 'success' : 'error',
            'notif_message' => $action ? $successMessage : $errorMessage,
            'notif_duration' => $duration,
        ]);
    }
}
