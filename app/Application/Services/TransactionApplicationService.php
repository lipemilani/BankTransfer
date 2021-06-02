<?php

namespace App\Application\Services;

use App\Domain\Services\TransactionDomainService;
use App\Application\Transformers\TransactionTransformer;
use App\Infrastructure\Repositories\TransactionRepository;

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
}
