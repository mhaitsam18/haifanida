<?php

namespace App\Http\Controllers;

use App\Models\Costing\AncillaryProduct;
use App\Models\Costing\Costing;
use App\Models\Costing\PackageTier;
use App\Models\Costing\Quotation;
use App\Services\Costing\Preview\CostingPreviewService;
use App\Services\Costing\Quotation\QuotationService;
use App\Services\Costing\Snapshot\CostingSnapshotService;
use App\Services\Costing\Support\AuditLogger;
use Illuminate\Http\Request;

/**
 * Costing workflow. One wizard, two modes: block (publish flow) and on-demand
 * (private quotation flow). Procurement mode is chosen up front and reshapes the
 * remaining steps — a private quote never shows a seat-block step or a
 * materialisation panel at all. HPP is behind the office-admin gate.
 */
class AdminCostingController extends Controller
{
    public function index()
    {
        return view('admin.costing.index', [
            'title' => 'Costing / HPP',
            'page' => 'costing',
            'costings' => Costing::with('creator')->latest('id')->limit(50)->get(),
            'quotations' => Quotation::with('creator')->latest('id')->limit(30)->get(),
        ]);
    }

    public function create()
    {
        return $this->wizard(null, old());
    }

    public function preview(Request $request, CostingPreviewService $service)
    {
        [$overrides, $ancillaryItems] = $this->buildInputs($request);
        $preview = $service->preview($overrides, $ancillaryItems);

        return $this->wizard($preview, $request->all());
    }

    public function store(Request $request, CostingSnapshotService $snapshots, QuotationService $quotations)
    {
        [$overrides, $ancillaryItems, $config] = $this->buildInputs($request, withConfig: true);
        $paketId = $request->filled('paket_id') ? (int) $request->input('paket_id') : null;

        $costing = $snapshots->createFromOverrides($overrides, $ancillaryItems, $paketId, auth()->id());

        if (($overrides['procurement_mode'] ?? 'block') === 'on_demand') {
            $quote = $quotations->save(
                costing: $costing,
                config: $config,
                customerName: $request->input('customer_name'),
                validDays: (int) config('costing.quotation_valid_days', 14),
                actorId: auth()->id(),
            );

            return redirect()->route('admin.costing.show', $costing->id)
                ->with('success', "Kuotasi {$quote->reference} v{$quote->version} tersimpan (berlaku s/d {$quote->valid_until->format('d M Y')}).");
        }

        return redirect()->route('admin.costing.show', $costing->id)
            ->with('success', 'Costing tersimpan sebagai draft.');
    }

    public function show(Costing $costing, AuditLogger $audit)
    {
        // Audit HPP VIEWS, not only edits — the interim adminkantor audience is
        // wider than desired until executive roles land (Addendum 4).
        $audit->record('costing.viewed', $costing, null, null, null, auth()->id());

        $quote = Quotation::where('costing_id', $costing->id)->latest('version')->first();

        return view('admin.costing.show', [
            'title' => 'Costing #'.$costing->id,
            'page' => 'costing',
            'costing' => $costing->load(['lines', 'publishedPrices', 'ancillaries']),
            'quote' => $quote,
            'expiredWarning' => $quote && $quote->isExpired(),
        ]);
    }

    private function wizard(?array $preview, array $input)
    {
        return view('admin.costing.wizard', [
            'title' => 'Costing Baru',
            'page' => 'costing',
            'tiers' => PackageTier::orderBy('sort_order')->get(),
            'ancillaryProducts' => AncillaryProduct::orderBy('sort_order')->get(),
            'preview' => $preview,
            'input' => $input,
        ]);
    }

    /**
     * @return array{0: array<string,mixed>, 1: array<int,array<string,mixed>>, 2?: array<string,mixed>}
     */
    private function buildInputs(Request $request, bool $withConfig = false): array
    {
        $rateOverrides = [];
        foreach (['tiket_pesawat', 'hotel_makkah', 'hotel_madinah'] as $key) {
            if ($request->filled("rate_$key")) {
                $rateOverrides[$key] = (float) $request->input("rate_$key");
            }
        }

        $overrides = [
            'costing_date' => $request->input('costing_date', now()->toDateString()),
            'procurement_mode' => $request->input('procurement_mode', 'block'),
            'package_tier' => $request->input('package_tier', 'standard'),
            'paying_pax' => (int) $request->input('paying_pax', 35),
            'free_seats' => (int) $request->input('free_seats', 0),
            'night_makkah' => (int) $request->input('night_makkah', 4),
            'night_madinah' => (int) $request->input('night_madinah', 4),
            'occupancy' => (int) $request->input('occupancy', 4),
            'saudi_ground_days' => (int) $request->input('saudi_ground_days', 8),
            'publish_price' => (float) $request->input('publish_price', 0),
            'seats_booked' => (int) $request->input('seats_booked', $request->input('paying_pax', 35)),
            'materialisation_basis' => $request->input('materialisation_basis', 'booked'),
            'transit_villa' => $request->boolean('transit_villa'),
            'handling_bundled_la' => $request->boolean('handling_bundled_la'),
            'mutawwif_free' => $request->boolean('mutawwif_free'),
            'tl_opt_in' => $request->boolean('tl_opt_in'),
            'rate_overrides' => $rateOverrides,
        ];

        $ancillaryItems = [];
        foreach (AncillaryProduct::all() as $p) {
            $packaging = $request->input("ancillary_{$p->key}_packaging");
            if ($packaging === 'none' || $packaging === null) {
                continue;
            }
            $ancillaryItems[] = [
                'key' => $p->key,
                'nama' => $p->nama,
                'packaging' => $packaging,
                'cost' => (float) ($p->default_cost ?? 0),
                'sell' => (float) ($p->default_sell ?? 0),
                'takeup_pct' => $p->default_takeup_pct !== null ? (float) $p->default_takeup_pct : null,
            ];
        }

        if ($withConfig) {
            return [$overrides, $ancillaryItems, array_merge($overrides, ['ancillary' => $ancillaryItems])];
        }

        return [$overrides, $ancillaryItems];
    }
}
