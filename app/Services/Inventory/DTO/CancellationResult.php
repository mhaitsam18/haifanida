<?php

namespace App\Services\Inventory\DTO;

readonly class CancellationResult
{
    public function __construct(
        public bool $success,
        public ?string $status = null,       // e.g. cancelled, pending, rejected
        public ?float $refundAmount = null,
        public ?string $currency = null,
        public ?string $errorMessage = null,
        public array $raw = [],
    ) {}
}
