<?php

namespace App\Services\Costing\Exceptions;

use RuntimeException;

class FxPolicyException extends RuntimeException
{
    public static function belowPeg(float $sar, float $implied): self
    {
        return new self(sprintf(
            'SAR rate %.2f is below the peg-implied floor %.2f; refusing to remove the safety buffer.',
            $sar,
            $implied,
        ));
    }

    public static function noPolicy(string $date): self
    {
        return new self("No FX policy version is effective on or before {$date}.");
    }
}
