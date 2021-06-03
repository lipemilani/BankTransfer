<?php

namespace App\Application\Actions\Transactions;

use App\Application\DTO\TransactionDTO;
use App\Application\Validations\Message;
use App\Domain\Tasks\Customers\TransferTask;
use App\Domain\Tasks\Transactions\SuccessfulTask;
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
        $validateBalance = app(ValidateBalanceTask::class)->execute($dto->payerId, $dto->transactionValue);

        if (!$validateBalance) {
            Message::execute('Saldo indisponível na carteira.');
        }

        $authorizationIntegration = app(AuthorizationService::class)->send();

        if (!$authorizationIntegration) {
            Message::execute('Serviço autorizador externo temporariamente fora do ar.');
        }

        app(TransferTask::class)->execute($dto);

        app(NotificationService::class)->send();

        app(SuccessfulTask::class)->execute($dto);
        $transactionModel = $this->transformer->toModel($dto);
        return $this->service->create($transactionModel);
    }
}
