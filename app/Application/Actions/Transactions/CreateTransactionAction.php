<?php

namespace App\Application\Actions\Transactions;

use App\Application\DTO\TransactionDTO;
use App\Application\Validations\Message;
use App\Domain\Tasks\Customers\TransferTask;
use App\Domain\Tasks\Transactions\CreateTransactionTask;
use App\Domain\Tasks\Transactions\SuccessfulTask;
use App\Domain\Tasks\Transactions\UnsuccessfullyTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Domain\Services\TransactionDomainService;
use App\Domain\Tasks\Customers\ValidateBalanceTask;
use App\Application\Transformers\TransactionTransformer;
use App\Infrastructure\Integrations\NotificationService;
use App\Infrastructure\Integrations\AuthorizationService;

/**
 * Class CreateTransactionAction
 * @package App\Application\Actions
 */
class CreateTransactionAction
{

    /**
     * @param TransactionDTO $dto
     * @return \Illuminate\Database\Eloquent\Model
     * @throws ValidationException
     */
    public function execute(TransactionDTO $dto)
    {
        $validateBalance = $this->validateBalance($dto);

        if (!$validateBalance) {
            Message::execute('Saldo indisponível na carteira.');
        }

        $isSuccessful = $this->executeTransfer($dto);

        $this->notifyUser();

        return $this->createTransaction($dto, $isSuccessful);
    }

    /**
     * @param TransactionDTO $dto
     * @return mixed
     */
    private function validateBalance(TransactionDTO $dto)
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

    private function notifyUser()
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
