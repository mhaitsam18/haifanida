<?php

namespace Database\Seeders;

use App\Models\Costing\FxPolicyVersion;
use Illuminate\Database\Seeder;

/**
 * Seeds the confirmed FX policy history: the previous USD Rp16,500 policy
 * (closed) and the current USD Rp18,000 / SAR Rp5,000 policy (open). SAR values
 * sit above the 3.75 peg-implied floor by design (the management buffer).
 * Idempotent on effective_from.
 */
class FxPolicyVersionSeeder extends Seeder
{
    public function run(): void
    {
        // Previous policy: USD 16,500 (implied SAR 4,400; buffered to 4,500).
        FxPolicyVersion::updateOrCreate(
            ['effective_from' => '2025-01-01'],
            [
                'base_currency' => 'USD',
                'usd_idr' => 16_500,
                'sar_idr' => 4_500,
                'peg_sar_per_usd' => 3.75,
                'effective_to' => '2026-07-01',
                'reason' => 'Kebijakan kurs sebelumnya (data awal).',
            ],
        );

        // Current policy: USD 18,000 (implied SAR 4,800; buffered to 5,000).
        FxPolicyVersion::updateOrCreate(
            ['effective_from' => '2026-07-01'],
            [
                'base_currency' => 'USD',
                'usd_idr' => 18_000,
                'sar_idr' => 5_000,
                'peg_sar_per_usd' => 3.75,
                'effective_to' => null,
                'reason' => 'Kebijakan kurs berjalan.',
            ],
        );
    }
}
