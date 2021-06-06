<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Tasks\Customers\ValidateBalanceTask;

/**
 * Class ValidateBalanceTest
 * @package Tests\Feature
 */
class ValidateBalanceTest extends TestCase
{

    public function test_validate_balance_true()
    {
        $result = app(ValidateBalanceTask::class)->execute(1, 10);

        $this->assertEquals(true, $result);
    }

    public function test_validate_balance_false()
    {
        $result = app(ValidateBalanceTask::class)->execute(1, 1000);

        $this->assertEquals(false, $result);
    }
}
