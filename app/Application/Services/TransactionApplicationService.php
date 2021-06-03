<?php

namespace App\Application\Services;

use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;
use App\Domain\Services\TransactionDomainService;
use App\Application\Transformers\TransactionTransformer;
use App\Infrastructure\Repositories\TransactionRepository;
use App\Application\Actions\Transactions\CreateTransactionAction;

/**
 * Class TransactionApplicationService
 * @package App\Application\Services
 */
class TransactionApplicationService extends ApplicationService
{

    /**
     * TransactionApplicationService constructor.
     * @param TransactionDomainService $service
     * @param TransactionTransformer $transformer
     * @param TransactionRepository $repository
     */
    public function __construct(TransactionDomainService $service, TransactionTransformer $transformer, TransactionRepository $repository)
    {
        parent::__construct($service, $transformer, $repository);
    }

    public function store(DataTransferObject $dto): ?Model
    {
        return app(CreateTransactionAction::class)->execute($dto);
    }
}
