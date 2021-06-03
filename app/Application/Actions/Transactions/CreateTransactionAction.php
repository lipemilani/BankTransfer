<?php

namespace App\Application\Actions\Transactions;

use App\Application\DTO\TransactionDTO;
use App\Application\Validations\Message;
use App\Domain\Tasks\Customers\TransferTask;
use App\Domain\Tasks\Transactions\SuccessfulTask;
use Illuminate\Database\Eloquent\Model;
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
     * @var TransactionTransformer
     */
    protected TransactionTransformer $transformer;

    /**
     * @var TransactionDomainService
     */
    protected TransactionDomainService $service;

    /**
     * CreateTransactionAction constructor.
     * @param TransactionTransformer $transformer
     * @param TransactionDomainService $service
     */
    public function __construct(TransactionTransformer $transformer, TransactionDomainService $service)
    {
        $this->transformer = $transformer;
        $this->service = $service;
    }

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

        $authorizationIntegration = $this->checkAuthorization();

        if (!$authorizationIntegration) {
            Message::execute('Serviço autorizador externo temporariamente fora do ar.');
        }

        $this->executeTransfer($dto);

        $this->notifyUser();

        return $this->createTransaction($dto);
    }

    /**
     * @param TransactionDTO $dto
     * @return mixed
     */
    private function validateBalance(TransactionDTO $dto)
    {
        return app(ValidateBalanceTask::class)->execute($dto->payerId, $dto->transactionValue);
    }

    private function checkAuthorization()
    {
        return app(AuthorizationService::class)->send();
    }

    private function executeTransfer(TransactionDTO $dto)
    {
        app(TransferTask::class)->execute($dto);
    }

    private function notifyUser()
    {
        app(NotificationService::class)->send();
    }

    /**
     * @param TransactionDTO $dto
     * @return Model
     */
    private function createTransaction(TransactionDTO $dto): Model
    {
        app(SuccessfulTask::class)->execute($dto);
        $transactionModel = $this->transformer->toModel($dto);
        return $this->service->create($transactionModel);
    }
}
