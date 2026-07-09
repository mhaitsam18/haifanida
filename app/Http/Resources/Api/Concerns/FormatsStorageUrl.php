<?php

namespace App\Http\Resources\Api\Concerns;

trait FormatsStorageUrl
{
    /**
     * The app stores every upload's DB column as a path relative to the
     * `public` disk (e.g. "paket-gambar/xxx.jpg") and every Blade view
     * builds the URL as asset('storage/'.$path) — mirrored here so API
     * consumers get the same absolute URL.
     */
    protected function storageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return url('storage/'.$path);
    }
}
