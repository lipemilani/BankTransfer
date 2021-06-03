<?php

namespace App\Domain\Tasks\Customers;

use App\Domain\Models\Customer;

/**
 * Class ValidateBalanceTask
 * @package App\Domain\Tasks
 */
class ValidateBalanceTask
{
    /**
     * @param int $payerId
     * @param float $transactionValue
     * @return bool
     */
    public function execute(int $payerId, float $transactionValue): bool
    {
        /**
         * @var Customer $customer
         */
        $customer = Customer::find($payerId);

        $currentBalance = $customer->balance;

        if ($currentBalance >= $transactionValue) {
            return true;
        }

        return false;
    }
}
