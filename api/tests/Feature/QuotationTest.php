<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Seeders\AgeSeeder;
use Database\Seeders\CurrencySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuotationTest extends TestCase
{
    use RefreshDatabase;

    public function test_quotation(): void
    {
        $this->seed([AgeSeeder::class, CurrencySeeder::class]);

        $response = $this->getAuthorizedRequest()->postJson('/quotation', [
            'age' => '28,35',
            'currency_id' => 'EUR',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-30',
        ]);

        $response->assertCreated();
    }

    public function test_quotation_guard(): void
    {
        $this->seed([AgeSeeder::class, CurrencySeeder::class]);

        $response = $this->postJson('/quotation', [
            'age' => '28,35',
            'currency_id' => 'EUR',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-30',
        ]);

        $response->assertUnauthorized();
    }

    public function test_unsupported_age_error(): void
    {
        $this->seed([AgeSeeder::class, CurrencySeeder::class]);

        $response = $this->getAuthorizedRequest()->postJson('/quotation', [
            'age' => '98',
            'currency_id' => 'EUR',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-30',
        ]);

        $response->assertUnprocessable();
    }

    public function test_duplicated_age(): void
    {
        $this->seed([AgeSeeder::class, CurrencySeeder::class]);

        $response = $this->getAuthorizedRequest()->postJson('/quotation', [
            'age' => '70,70',
            'currency_id' => 'EUR',
            'start_date' => '2020-10-01',
            'end_date' => '2020-10-30',
        ]);

        $response->assertJson(['data' => ['total' => 180]]);
    }
}
