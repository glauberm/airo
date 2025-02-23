<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\QuotationService;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class QuotationTest extends TestCase
{
    public function test_calculate_value(): void
    {
        $service = $this->app->make(QuotationService::class);

        $startDate = CarbonImmutable::createFromFormat('Y-m-d', '2020-10-01');

        $endDate = CarbonImmutable::createFromFormat('Y-m-d', '2020-10-30');

        $value = $service->calculateValue(0.6, $startDate, $endDate);

        self::assertEquals(54, $value);
    }
}
