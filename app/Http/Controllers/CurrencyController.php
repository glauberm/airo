<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Currency as CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CurrencyController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return CurrencyResource::collection(Currency::all());
    }
}
