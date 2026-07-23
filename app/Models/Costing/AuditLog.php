<?php

namespace App\Models\Costing;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Append-only audit record. Written by AuditLogger; never updated (no
 * updated_at). Polymorphic on the audited subject so FX revisions, rate-card
 * supersessions, and margin overrides all share one trail.
 */
class AuditLog extends Model
{
    protected $table = 'audit_log';
    protected $guarded = ['id'];

    public const UPDATED_AT = null;

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
