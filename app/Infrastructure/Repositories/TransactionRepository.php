<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Transaction;

/**
 * Class TransactionRepository
 * @package App\Infrastructure\Repositories
 */
class TransactionRepository extends EntityRepository
{
    protected string $entityClassName = Transaction::class;
}
