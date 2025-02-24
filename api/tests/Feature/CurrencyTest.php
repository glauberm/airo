<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Seeders\CurrencySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    public function test_currency_list(): void
    {
        $this->seed(CurrencySeeder::class);

        $response = $this->getAuthorizedRequest()->getJson('/currencies');

        $response->assertOk();
    }

    public function test_currency_list_guard(): void
    {
        $this->seed(CurrencySeeder::class);

        $response = $this->getJson('/currencies');

        $response->assertUnauthorized();
    }
}
