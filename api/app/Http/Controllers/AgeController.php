<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Age as AgeResource;
use App\Models\Age;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AgeController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('auth:api')];
    }

    public function __invoke(): AnonymousResourceCollection
    {
        return AgeResource::collection(Age::all());
    }
}
