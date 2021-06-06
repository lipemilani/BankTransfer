<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Infrastructure\Integrations\NotificationService;
use App\Infrastructure\Integrations\AuthorizationService;

/**
 * Class IntegrationTest
 * @package Tests\Feature
 */
class IntegrationTest extends TestCase
{

    public function test_authorization()
    {
        $result = app(AuthorizationService::class)->send();

        $this->assertEquals(true, $result);
    }

    public function test_notification()
    {
        $result = app(NotificationService::class)->send();

        $this->assertEquals(true, $result);
    }
}
