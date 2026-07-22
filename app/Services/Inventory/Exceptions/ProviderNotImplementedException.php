<?php

namespace App\Services\Inventory\Exceptions;

use RuntimeException;

/**
 * Thrown by an adapter method whose provider-specific request/response
 * mapping has not been completed yet. Used deliberately so the seam and
 * credential plumbing can ship without fabricating a provider's API schema.
 */
class ProviderNotImplementedException extends RuntimeException {}
