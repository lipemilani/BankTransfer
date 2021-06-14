<?php

namespace App\Domain\Actions\Transactions;

use App\Domain\Log\ValidationLog;
use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\TransactionDTO;
use App\Domain\Tasks\Customers\TransferTask;
use Illuminate\Validation\ValidationException;
use App\Domain\Tasks\Customers\ValidateBalanceTask;
use App\Infrastructure\Integrations\NotificationService;
use App\Domain\Tasks\Transactions\CreateTransactionTask;

/**
 * Class CreateTransactionAction
 * @package App\Application\Actions
 */
class CreateTransactionAction
{

    /**
     * @param TransactionDTO $dto
     * @return Model
     * @throws ValidationException
     */
    public function execute(TransactionDTO $dto): Model
    {
        $validateBalance = $this->validateBalance($dto);

        if (!$validateBalance) {
            ValidationLog::send('Saldo indisponível na carteira.');
        }

        $isSuccessful = $this->executeTransfer($dto);

        $this->notifyUser();

        return $this->createTransaction($dto, $isSuccessful);
    }

    /**
     * @param TransactionDTO $dto
     * @return bool
     */
    private function validateBalance(TransactionDTO $dto): bool
    {
        return app(ValidateBalanceTask::class)->execute($dto->payerId, $dto->transactionValue);
    }

    /**
     * @param TransactionDTO $dto
     * @return bool
     */
    private function executeTransfer(TransactionDTO $dto): bool
    {
        return app(TransferTask::class)->execute($dto);
    }

    /**
     * @return void
     */
    private function notifyUser(): void
    {
        app(NotificationService::class)->send();
    }

    /**
     * @param TransactionDTO $dto
     * @param bool $isSuccessful
     * @return Model
     */
    private function createTransaction(TransactionDTO $dto, bool $isSuccessful): Model
    {
        return app(CreateTransactionTask::class)->execute($dto, $isSuccessful);
    }
}
