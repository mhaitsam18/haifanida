<?php

namespace App\Http\Controllers;

use App\Models\Costing\AuditLog;
use App\Models\Costing\FxPolicyVersion;
use App\Services\Costing\Fx\FxPolicyService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminFxPolicyController extends Controller
{
    public function index(FxPolicyService $service)
    {
        $current = null;
        try {
            $current = $service->current();
        } catch (\Throwable) {
            // No policy configured yet — the view shows an empty state.
        }

        return view('admin.fx-policy.index', [
            'title' => 'Kurs Kebijakan (FX)',
            'page' => 'fx-policy',
            'current' => $current,
            'peg' => $service->peg(),
            'history' => FxPolicyVersion::with('creator')
                ->orderByDesc('effective_from')->orderByDesc('id')->limit(50)->get(),
            'audits' => AuditLog::where('action', 'like', 'fx_policy.%')
                ->with('user')->latest('id')->limit(20)->get(),
        ]);
    }

    public function store(Request $request, FxPolicyService $service)
    {
        $data = $request->validate([
            'usd_idr' => ['required', 'numeric', 'min:1000'],
            'sar_idr' => ['required', 'numeric', 'min:100'],
            'effective_from' => ['required', 'date'],
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        // Peg guard as a validation error so the modal shows it inline (422 JSON).
        $check = $service->validatePeg((float) $data['usd_idr'], (float) $data['sar_idr']);
        if ($check['blocked']) {
            throw ValidationException::withMessages([
                'sar_idr' => sprintf(
                    'Kurs SAR Rp%s di bawah nilai patokan Rp%s (peg 3,75). Tidak boleh di bawah patokan — bantalan keamanan hilang.',
                    number_format((float) $data['sar_idr'], 0, ',', '.'),
                    number_format($check['implied'], 0, ',', '.'),
                ),
            ]);
        }

        $version = $service->revise($data, auth()->id());

        $redirect = redirect()->route('admin.fx-policy.index')->with(
            'success',
            sprintf(
                'Kurs kebijakan diperbarui: USD Rp%s, SAR Rp%s, berlaku %s.',
                number_format((float) $version->usd_idr, 0, ',', '.'),
                number_format((float) $version->sar_idr, 0, ',', '.'),
                $version->effective_from->format('d M Y'),
            ),
        );

        if ($check['warning']) {
            $redirect->with('warning', $check['warning']);
        }

        return $redirect;
    }
}
