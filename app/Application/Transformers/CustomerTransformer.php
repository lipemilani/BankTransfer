<?php

namespace App\Application\Transformers;

use App\Domain\Models\Customer;
use App\Application\DTO\CustomerDTO;
use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;

/**
 * Class CustomerTransformer
 * @package App\Application\Transformers
 */
class CustomerTransformer extends Transformer
{
    /**
     * @param CustomerDTO|DataTransferObject $dto
     * @return Customer
     */
    public function toModel(DataTransferObject $dto): Customer
    {
        $customer = new Customer();

        $customer->id = $dto->id;
        $customer->created_at = $dto->createdAt;
        $customer->updated_at = $dto->updatedAt;
        $customer->active = $dto->active;
        $customer->name = $dto->name;
        $customer->cpf = $dto->cpf;
        $customer->email = $dto->email;
        $customer->password = $dto->password;
        $customer->balance = $dto->balance;
        $customer->type = $dto->type;

        return $customer;
    }

    /**
     * @param Customer|Model $model
     * @param CustomerDTO|DataTransferObject $dto
     * @return mixed|void
     */
    public function prepareForUpdate(Model &$model, DataTransferObject $dto)
    {
        !array_key_exists('active', $dto->requestData) ?: $model->active = $dto->active;
        !array_key_exists('name', $dto->requestData) ?: $model->name = $dto->name;
        !array_key_exists('cpf', $dto->requestData) ?: $model->cpf = $dto->cpf;
        !array_key_exists('email', $dto->requestData) ?: $model->email = $dto->email;
        !array_key_exists('password', $dto->requestData) ?: $model->password = $dto->password;
        !array_key_exists('balance', $dto->requestData) ?: $model->balance = $dto->balance;
        !array_key_exists('type', $dto->requestData) ?: $model->type = $dto->type;
    }
}
