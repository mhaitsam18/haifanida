<?php

namespace Database\Seeders;

use App\Models\Costing\CostComponent;
use App\Models\Costing\RateCard;
use Illuminate\Database\Seeder;

/**
 * Seeds the workbook's currently-prevailing unit rates as BASELINE rate cards
 * (source='baseline', no vendor) — the internal assumption a costing uses until
 * a contracted vendor rate exists. Amounts are the "Harga Satuan" column of the
 * Biaya Produksi / Produk Tambahan sheets, in each component's native currency.
 * Idempotent on (component, source, valid_from).
 */
class BaselineRateCardSeeder extends Seeder
{
    public function run(): void
    {
        $validFrom = '2026-07-01';   // aligns with the current FX policy version

        // component key => baseline unit amount (native currency of the component)
        $rates = [
            'tiket_pesawat' => 16_500_000,
            'hotel_makkah' => 4_750_000,
            'hotel_madinah' => 4_000_000,
            'visa_umroh' => 140,        // USD
            'farkiyah' => 20,           // USD per seat below floor
            'tasreh_raudhah' => 30,     // SAR
            'mutawwif' => 250,          // SAR per day
            'tour_leader' => 1_000_000,
            'local_arrangement' => 500_000,
            'transit_villa' => 150_000,
            'handling_cgk' => 150_000,  // per leg
            'handling_makkah_madinah' => 75,  // USD (low end of 75–100+)
            'asuransi' => 65_000,
            'administrasi' => 250_000,
            'operasional_kantor' => 500_000,
            'cadangan_risiko' => 1_000_000,
            'gaji_staff' => 1_000_000,  // workbook figure; annual-pool correction (~1.2jt) is derived in phase 3
            'fee_agen' => 1_500_000,
            'perlengkapan_manasik' => 2_000_000,
            'bus_indonesia' => 200_000,
            'vaksin' => 500_000,
            'paspor' => 150_000,
            'merchandise' => 200_000,
        ];

        $components = CostComponent::whereIn('key', array_keys($rates))->get()->keyBy('key');

        foreach ($rates as $key => $amount) {
            $component = $components->get($key);
            if (! $component) {
                continue;
            }

            RateCard::updateOrCreate(
                [
                    'cost_component_id' => $component->id,
                    'source' => 'baseline',
                    'valid_from' => $validFrom,
                ],
                [
                    'vendor_service_id' => null,
                    'currency' => $component->default_currency,
                    'amount' => $amount,
                    'unit' => $component->default_unit,
                    'valid_to' => null,
                    'notes' => 'Baseline internal (tarif prevailing dari workbook). Bukan tarif kontrak vendor.',
                ],
            );
        }
    }
}
