<?php

namespace App\Http\Requests\Rules\Customers;

use App\Domain\Models\Customer;
use Illuminate\Contracts\Validation\ImplicitRule;

/**
 * Class CheckIfCustomerExist
 * @package App\Http\Requests\Rules\Customers
 */
class CheckIfCustomerExist implements ImplicitRule
{
    /**
     * @var array
     */
    protected ?array $attributes;

    /**
     * @var array
     */
    protected array $errorMessage;

    /**
     * CheckIfCustomerExist constructor.
     * @param array|null $attributes
     */
    public function __construct(?array $attributes)
    {
        $this->attributes = $attributes;
        $this->errorMessage = [];
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $payerId = data_get($this->attributes, 'payer_id', null);
        $payeeId = data_get($this->attributes, 'payee_id', null);

        $customer = Customer::find($payerId);

        if (blank($customer)) {
            $this->errorMessage[] = 'Pagador';
        }

        $customer = Customer::find($payeeId);

        if (blank($customer)) {
            $this->errorMessage[] = 'Beneficiário';
        }

        if (!blank($this->errorMessage)) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message()
    {
        return implode (", ", $this->errorMessage) . ' não existe.';
    }
}
