<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class RootViewTest extends TestCase
{
    public function test_root_view(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }
}
