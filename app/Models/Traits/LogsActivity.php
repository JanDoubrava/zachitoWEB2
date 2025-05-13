<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Log;

trait LogsActivity
{
    /**
     * Loguje aktivitu uživatele.
     *
     * @param string $action Typ akce (např. 'create', 'update', 'delete')
     * @param string $description Popis akce
     * @param array $data Další data pro log
     * @return void
     */
    protected function logActivity(string $action, string $description, array $data = []): void
    {
        $user = auth()->user();
        $logData = array_merge([
            'user_id' => $user ? $user->id : null,
            'user_name' => $user ? $user->name : 'Guest',
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now(),
        ], $data);

        Log::channel('activity')->info('User Activity', $logData);
    }
} 