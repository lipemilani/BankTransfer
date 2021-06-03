<?php

namespace App\Domain\Tasks\Customers;

use App\Application\DTO\TransactionDTO;
use App\Domain\Models\Customer;
use App\Domain\Services\CustomerDomainService;

class TransferTask
{
    protected CustomerDomainService $service;

    public function __construct(CustomerDomainService $service)
    {
        $this->service = $service;
    }

    public function execute(TransactionDTO $dto)
    {
        $this->updatePayerBalance($dto);

        $this->updatePayeeBalance($dto);
    }

    /**
     * @param TransactionDTO $dto
     */
    private function updatePayerBalance(TransactionDTO $dto)
    {
        $payer = Customer::find($dto->payerId);

        $payer->balance = $payer->balance - $dto->transactionValue;

        $this->service->update($payer);
    }

    /**
     * @param TransactionDTO $dto
     */
    private function updatePayeeBalance(TransactionDTO $dto)
    {
        $payee = Customer::find($dto->payeeId);

        $payee->balance += $dto->transactionValue;

        $this->service->update($payee);
    }
}
