<?php

namespace App\Domain\Tasks\Transactions;

use App\Application\DTO\TransactionDTO;

/**
 * Class UnsuccessfullyTask
 * @package App\Domain\Tasks\Transactions
 */
class UnsuccessfullyTask
{
    /**
     * @param TransactionDTO $dto
     */
    public function execute(TransactionDTO &$dto)
    {
        $dto->isSuccess = false;
    }
}
