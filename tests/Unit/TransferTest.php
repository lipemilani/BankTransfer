<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Application\DTO\TransactionDTO;
use App\Domain\Tasks\Customers\TransferTask;

/**
 * Class TransferTest
 * @package Tests\Feature
 */
class TransferTest extends TestCase
{

    public function test_transfer()
    {
        $transactionDto = TransactionDTO::fromArray([
            'payer_id' => 1,
            'payee_id' => 2,
            'transaction_value' => 50
        ]);

        $result = app(TransferTask::class)->execute($transactionDto);

        $this->assertEquals(true, $result);
    }
}
