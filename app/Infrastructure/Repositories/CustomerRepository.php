<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Customer;

/**
 * Class CustomerRepository
 * @package App\Infrastructure\Repositories
 */
class CustomerRepository extends EntityRepository
{
    protected string $entityClassName = Customer::class;
}
