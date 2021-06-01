<?php

namespace App\Application\Services;

use App\Domain\Services\CustomerDomainService;
use App\Application\Transformers\CustomerTransformer;
use App\Infrastructure\Repositories\CustomerRepository;

/**
 * Class CustomerApplicationService
 * @package App\Application\Services
 */
class CustomerApplicationService extends ApplicationService
{

    /**
     * CustomerApplicationService constructor.
     * @param CustomerDomainService $service
     * @param CustomerTransformer $transformer
     * @param CustomerRepository $repository
     */
    public function __construct(CustomerDomainService $service, CustomerTransformer $transformer, CustomerRepository $repository)
    {
        parent::__construct($service, $transformer, $repository);
    }
}
