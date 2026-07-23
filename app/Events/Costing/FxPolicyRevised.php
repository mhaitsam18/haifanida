<?php

namespace App\Events\Costing;

use App\Models\Costing\FxPolicyVersion;
use Illuminate\Foundation\Events\Dispatchable;

/**
 * Fired when a new FX policy version is created. The audit row is written
 * synchronously inside FxPolicyService (guaranteed), so this event is an
 * extensibility hook for later consumers (e.g. notifying finance, invalidating
 * cached costings) — not the audit mechanism itself.
 */
class FxPolicyRevised
{
    use Dispatchable;

    public function __construct(
        public FxPolicyVersion $version,
        public ?FxPolicyVersion $previous = null,
    ) {}
}
