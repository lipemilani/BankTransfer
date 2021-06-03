<?php

namespace App\Domain\Tasks\Transactions;

use App\Application\DTO\TransactionDTO;

/**
 * Class SuccessfulTask
 * @package App\Domain\Tasks\Transactions
 */
class SuccessfulTask
{
    /**
     * @param TransactionDTO $dto
     * @return bool
     */
    public function execute(TransactionDTO &$dto)
    {
        return $dto->isSuccess = true;
    }
}
