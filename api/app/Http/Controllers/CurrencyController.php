<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Currency as CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CurrencyController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('auth:api')];
    }

    public function __invoke(): AnonymousResourceCollection
    {
        return CurrencyResource::collection(Currency::all());
    }
}
