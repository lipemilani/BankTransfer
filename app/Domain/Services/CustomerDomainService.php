<?php

namespace App\Domain\Services;

use App\Domain\Models\Customer;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerDomainService
 * @package App\Domain\Services
 */
class CustomerDomainService extends DomainService
{

    /**
     * @param Customer|Model $model
     * @return Model
     */
    public function create(Model $model): Model
    {
        $model->password = bcrypt($model->password);

        return parent::create($model);
    }
}
