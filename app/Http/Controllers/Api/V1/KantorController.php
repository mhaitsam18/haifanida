<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\KantorResource;
use App\Models\Kantor;

class KantorController extends Controller
{
    public function index()
    {
        return KantorResource::collection(Kantor::all());
    }
}
