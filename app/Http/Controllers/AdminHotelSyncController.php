<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelExternalId;
use App\Models\HotelSyncRun;
use App\Services\Inventory\Contracts\SupportsContentSync;
use App\Services\Inventory\HotelSyncManager;
use App\Services\Inventory\InventoryManager;
use Illuminate\Http\Request;

class AdminHotelSyncController extends Controller
{
    public function index(HotelSyncManager $manager, InventoryManager $inventory)
    {
        $provider = $manager->currentProvider();

        // Is the provider capable of content sync, and are its credentials set?
        $supportsSync = false;
        try {
            $supportsSync = $inventory->provider($provider) instanceof SupportsContentSync;
        } catch (\Throwable) {
            $supportsSync = false;
        }
        $credentialsSet = ! empty(config("inventory.providers.{$provider}.base_url"))
            && ! empty(config("inventory.providers.{$provider}.username"));

        return view('admin.hotel-sync.index', [
            'title' => 'Sinkronisasi Hotel',
            'page' => 'hotel-sync',
            'provider' => $provider,
            'supportsSync' => $supportsSync,
            'credentialsSet' => $credentialsSet,
            'run' => $manager->latestRun(),
            'totalHotels' => Hotel::count(),
            'syncedCount' => HotelExternalId::forProvider($provider)->where('sync_status', 'synced')->count(),
            'failedCount' => HotelExternalId::forProvider($provider)->failed()->count(),
            'failedMappings' => HotelExternalId::forProvider($provider)->failed()->with('hotel')->latest('updated_at')->limit(100)->get(),
            'recentRuns' => HotelSyncRun::latest('id')->limit(10)->get(),
        ]);
    }

    public function start(Request $request, HotelSyncManager $manager)
    {
        $type = $request->input('type') === 'incremental' ? 'incremental' : 'full';
        $run = $manager->start($type);

        return redirect('/admin/hotel-sync')->with(
            'success',
            "Sinkronisasi ({$type}) dimulai — run #{$run->id}. Pastikan queue worker berjalan."
        );
    }
}
