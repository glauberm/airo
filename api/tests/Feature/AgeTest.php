<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Seeders\AgeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_age_list(): void
    {
        $this->seed(AgeSeeder::class);

        $response = $this->getAuthorizedRequest()->getJson('/ages');

        $response->assertOk();
    }

    public function test_age_list_guard(): void
    {
        $this->seed(AgeSeeder::class);

        $response = $this->getJson('/ages');

        $response->assertUnauthorized();
    }
}
