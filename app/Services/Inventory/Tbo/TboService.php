<?php

namespace App\Services\Inventory\Tbo;

use App\Services\Inventory\Contracts\InventoryProvider;
use App\Services\Inventory\Contracts\SupportsContentSync;
use App\Services\Inventory\DTO\BookingRequest;
use App\Services\Inventory\DTO\BookingResult;
use App\Services\Inventory\DTO\CancellationResult;
use App\Services\Inventory\DTO\HotelAvailabilityResult;
use App\Services\Inventory\DTO\HotelContent;
use App\Services\Inventory\DTO\HotelOffer;
use App\Services\Inventory\DTO\HotelSearchQuery;
use App\Services\Inventory\Exceptions\ProviderNotConfiguredException;
use App\Services\Inventory\Exceptions\ProviderNotImplementedException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * TBO Holidays adapter.
 *
 * WHAT IS REAL HERE: the credential plumbing (all read from config →
 * .env, never hardcoded), the authenticated HTTP client, and the mapping to
 * the provider-neutral InventoryProvider contract.
 *
 * WHAT IS DELIBERATELY PENDING: the exact TBO endpoint paths and request/
 * response field names. Those must be filled in from your TBO HotelAPI
 * documentation rather than guessed — fabricating a provider's schema would
 * be worse than an explicit, clearly-marked stub. Each method below shows
 * the intended shape and throws ProviderNotImplementedException until the
 * mapping is completed. No business code depends on any of this — it all
 * sits behind the InventoryProvider interface.
 *
 * @see \App\Services\Inventory\Contracts\InventoryProvider
 */
class TboService implements InventoryProvider, SupportsContentSync
{
    public function __construct(private readonly array $config) {}

    public function key(): string
    {
        return 'tbo';
    }

    /**
     * List TBO hotel codes for a city (intended: TBOHotelCodeList /
     * GiataHotelCodeList → city-wise, de-duplicated hotel codes). Mapping to be
     * completed from the TBO HotelAPI docs — not guessed.
     */
    public function listHotelCodes(string $city): array
    {
        $this->guardConfigured();

        throw new ProviderNotImplementedException(
            'TboService::listHotelCodes — complete the TBO hotel-code-list mapping from the TBO HotelAPI docs.'
        );
    }

    /**
     * A pre-configured, authenticated HTTP client. TBO's HotelAPI commonly
     * authenticates with HTTP Basic (username + password); if your account
     * uses a token/API key instead, switch to ->withToken($this->config['api_key']).
     */
    protected function http(): PendingRequest
    {
        $this->guardConfigured();

        return Http::baseUrl(rtrim($this->config['base_url'], '/'))
            ->timeout($this->config['timeout'] ?? 30)
            ->acceptJson()
            ->asJson()
            ->withBasicAuth($this->config['username'], $this->config['password']);
    }

    /** Ensures the required .env credentials are present before any live call. */
    protected function guardConfigured(): void
    {
        foreach (['base_url', 'username', 'password'] as $required) {
            if (empty($this->config[$required])) {
                throw new ProviderNotConfiguredException(
                    "TBO is not configured: missing '{$required}'. Set TBO_* values in your .env file."
                );
            }
        }
    }

    public function searchAvailability(HotelSearchQuery $query): HotelAvailabilityResult
    {
        $this->guardConfigured();

        // Intended shape (confirm names/paths against TBO HotelAPI docs):
        //   $response = $this->http()->post('/HotelSearch', [
        //       'CheckIn' => $query->checkIn, 'CheckOut' => $query->checkOut,
        //       'CityName' => $query->city, 'GuestNationality' => $query->nationality,
        //       'PreferredCurrency' => $query->currency, 'PaxRooms' => $query->rooms,
        //   ])->throw()->json();
        //   return new HotelAvailabilityResult(offers: $this->mapOffers($response), raw: $response);

        throw new ProviderNotImplementedException(
            'TboService::searchAvailability — complete the TBO request/response mapping from the TBO HotelAPI docs.'
        );
    }

    public function getHotelContent(string $externalHotelId): ?HotelContent
    {
        $this->guardConfigured();

        // Intended: GET/POST hotel-details endpoint → map to HotelContent
        // (leaving unmapped fields null, per the "NULL over guessing" rule).
        throw new ProviderNotImplementedException(
            'TboService::getHotelContent — complete the TBO hotel-details mapping from the TBO HotelAPI docs.'
        );
    }

    public function quote(string $rateKey): ?HotelOffer
    {
        $this->guardConfigured();

        // Intended: TBO PreBook/BlockRoom to re-validate price before booking.
        throw new ProviderNotImplementedException(
            'TboService::quote — complete the TBO pre-book (re-price) mapping from the TBO HotelAPI docs.'
        );
    }

    public function book(BookingRequest $request): BookingResult
    {
        $this->guardConfigured();

        // Intended: TBO Book endpoint → map confirmation number to BookingResult.
        throw new ProviderNotImplementedException(
            'TboService::book — complete the TBO booking mapping from the TBO HotelAPI docs.'
        );
    }

    public function cancel(string $bookingReference): CancellationResult
    {
        $this->guardConfigured();

        // Intended: TBO Cancel endpoint → map to CancellationResult.
        throw new ProviderNotImplementedException(
            'TboService::cancel — complete the TBO cancellation mapping from the TBO HotelAPI docs.'
        );
    }
}
