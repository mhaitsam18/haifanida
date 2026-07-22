<?php

namespace App\Services\Inventory\Exceptions;

use RuntimeException;

/** Thrown when a provider is used but its .env credentials are missing. */
class ProviderNotConfiguredException extends RuntimeException {}
