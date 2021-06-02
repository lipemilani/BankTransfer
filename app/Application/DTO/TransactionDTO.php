<?php

namespace App\Application\DTO;

use Carbon\Carbon;

/**
 * Class TransactionDTO
 * @package App\Application\DTO
 */
class TransactionDTO extends DataTransferObject
{
    public ?string $id;

    public ?int $payerId;

    public ?int $payeeId;

    public ?float $transactionValue;

    public ?bool $isSuccess;

}
