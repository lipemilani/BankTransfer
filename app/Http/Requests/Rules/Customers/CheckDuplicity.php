<?php

namespace App\Http\Requests\Rules\Customers;

use App\Domain\Models\Customer;
use Illuminate\Contracts\Validation\ImplicitRule;

/**
 * Class CheckDuplicity
 * @package App\Http\Requests\Rules
 */
class CheckDuplicity implements ImplicitRule
{
    /**
     * @var array
     */
    protected array $attributes;

    /**
     * CheckDuplicity constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $email = data_get($this->attributes, 'email', null);
        $cpf = data_get($this->attributes, 'cpf', null);

        $result = Customer::query()->where('email', $email)
            ->orWhere('cpf', $cpf)->get();

        if (!blank($result)) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message()
    {
        return 'E-mail ou Cpf já existentes!';
    }
}
