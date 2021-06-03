<?php

namespace App\Domain\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TransactionDomainService
 * @package App\Domain\Services
 */
class TransactionDomainService extends DomainService
{
    public function create(Model $model): Model
    {
        $model->save();

        return $model;
    }
}