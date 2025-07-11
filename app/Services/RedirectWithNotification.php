<?php

namespace App\Services;

class RedirectWithNotification
{
    public static function flash(bool $action, string $successMessage, string $errorMessage, int $duration)
    {
        return redirect()->back()->with([
            'notif_status' => $action ? 'success' : 'error',
            'notif_message' => $action ? $successMessage : $errorMessage,
            'notif_duration' => $duration,
        ]);
    }
}
