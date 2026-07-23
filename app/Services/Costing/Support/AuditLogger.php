<?php

namespace App\Services\Costing\Support;

use App\Models\Costing\AuditLog;
use Illuminate\Database\Eloquent\Model;

/**
 * Single write-point for the audit trail, so no edit site can forget to record.
 * Captures the acting user and request IP automatically when not supplied.
 */
class AuditLogger
{
    public function record(
        string $action,
        ?Model $subject = null,
        ?array $old = null,
        ?array $new = null,
        ?string $reason = null,
        ?int $userId = null,
    ): AuditLog {
        return AuditLog::create([
            'auditable_type' => $subject ? $subject::class : null,
            'auditable_id' => $subject?->getKey(),
            'action' => $action,
            'old_values' => $old,
            'new_values' => $new,
            'reason' => $reason,
            'user_id' => $userId ?? auth()->id(),
            'ip' => request()?->ip(),
            'created_at' => now(),
        ]);
    }
}
