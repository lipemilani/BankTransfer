<?php

namespace App\Domain\Tasks\Customers;

use App\Domain\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Application\DTO\TransactionDTO;
use App\Domain\Services\CustomerDomainService;
use App\Infrastructure\Integrations\AuthorizationService;

/**
 * Class TransferTask
 * @package App\Domain\Tasks\Customers
 */
class TransferTask
{
    /**
     * @var CustomerDomainService
     */
    protected CustomerDomainService $service;

    /**
     * TransferTask constructor.
     * @param CustomerDomainService $service
     */
    public function __construct(CustomerDomainService $service)
    {
        $this->service = $service;
    }

    /**
     * @param TransactionDTO $dto
     * @return bool
     */
    public function execute(TransactionDTO $dto): bool
    {
        DB::beginTransaction();

        $this->updatePayerBalance($dto);

        $this->updatePayeeBalance($dto);

        if (!$this->checkAuthorization()) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }

    /**
     * @return mixed
     */
    private function checkAuthorization(): bool
    {
        return app(AuthorizationService::class)->send();
    }

    /**
     * @param TransactionDTO $dto
     */
    private function updatePayerBalance(TransactionDTO $dto)
    {
        $payer = Customer::find($dto->payerId);
        $payer->balance = $payer->balance - $dto->transactionValue;
        $payer->save();
    }

    /**
     * @param TransactionDTO $dto
     */
    private function updatePayeeBalance(TransactionDTO $dto)
    {
        $payee = Customer::find($dto->payeeId);
        $payee->balance += $dto->transactionValue;
        $payee->save();
    }
}
