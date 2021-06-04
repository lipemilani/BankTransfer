<?php

namespace App\Domain\Tasks\Transactions;

use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\TransactionDTO;
use App\Domain\Services\TransactionDomainService;
use App\Application\Transformers\TransactionTransformer;

/**
 * Class CreateTransactionTask
 * @package App\Domain\Tasks\Transactions
 */
class CreateTransactionTask
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
     * @param bool $isSuccessful
     * @return Model
     */
    public function execute(TransactionDTO $dto, bool $isSuccessful): Model
    {
        !$isSuccessful
            ? app(UnsuccessfullyTask::class)->execute($dto)
            : app(SuccessfulTask::class)->execute($dto);

        $transactionModel = $this->transformer->toModel($dto);

        return $this->service->create($transactionModel);
    }
}
