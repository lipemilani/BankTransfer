<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Models\Transaction;
use App\Application\DTO\TransactionDTO;
use App\Domain\Actions\Transactions\CreateTransactionAction;

/**
 * Class CreateTransactionTest
 * @package Tests\Feature
 */
class CreateTransactionTest extends TestCase
{

    public function test_create_transaction()
    {
        $transactionDto = TransactionDTO::fromArray([
            'payer_id' => 1,
            'payee_id' => 2,
            'transaction_value' => 50
        ]);

        $result = app(CreateTransactionAction::class)->execute($transactionDto);

        $this->assertTrue(
            Transaction::query()->findOrFail(
                data_get($result, 'id')
            )->is_success == true
        );
    }
}
