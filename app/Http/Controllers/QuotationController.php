<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Http\Resources\Quotation;
use App\Services\QuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class QuotationController implements HasMiddleware
{
    public function __construct(private readonly QuotationService $service) {}

    public static function middleware(): array
    {
        return [new Middleware('auth:api')];
    }

    public function __invoke(QuotationRequest $request): JsonResponse|Quotation
    {
        $data = $request->validated();

        $quotation = $this->service->buildQuotation(...$data);

        return new Quotation($quotation);
    }
}
