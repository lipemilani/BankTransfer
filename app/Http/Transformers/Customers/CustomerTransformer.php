<?php

namespace App\Http\Transformers\Customers;

use App\Domain\Models\Customer;
use League\Fractal\TransformerAbstract;

/**
 * Class CustomerTransformer
 * @package App\Http\Transformers\Customers
 */
class CustomerTransformer extends TransformerAbstract
{
    /**
     * @param Customer $customer
     * @return array
     */
    public function transform(Customer $customer): array
    {
        return [
            'id' => $customer->id,
            'created_at' => $customer->created_at,
            'updated_at' => $customer->updated_at,
            'active' => $customer->active,
            'name' => $customer->name,
            'cpf' => $customer->cpf,
            'email' => $customer->email,
            'balance' => $customer->balance,
            'type' => $customer->type,
        ];
    }
}
