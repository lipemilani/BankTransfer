<?php

namespace App\Http\Requests\Rules\Transactions;

use App\Domain\Enums\TypeEnum;
use Illuminate\Contracts\Validation\ImplicitRule;

/**
 * Class CheckPayerType
 * @package App\Http\Requests\Rules\Transactions
 */
class CheckPayerType implements ImplicitRule
{
    /**
     * @var array
     */
    protected array $attributes;

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
        $payer = data_get($this->attributes, 'payer_id', null);

        if ($payer === TypeEnum::CUSTOMER_SHOPKEEPER) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message()
    {
        return 'Lojistas não podem efetuar transferências!';
    }
}
