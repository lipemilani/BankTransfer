<?php

namespace App\Application\Validations\Customer;

use App\Domain\Models\Customer;
use Illuminate\Contracts\Validation\ImplicitRule;

class CheckDuplicity implements ImplicitRule
{
    /**
     * @var array
     */
    protected array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

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

    public function message()
    {
        return 'E-mail ou Cpf já existentes';
    }
}
